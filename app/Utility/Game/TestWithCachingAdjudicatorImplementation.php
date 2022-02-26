<?php

namespace App\Utility\Game;

use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\AdjudicateGameResponseDTO;
use App\Utility\Game\DTO\BaseDTO;
use App\Utility\Game\DTO\DumbbotRequestDTO;
use App\Utility\Game\DTO\DumbbotResponseDTO;
use App\Utility\Game\DTO\VariantsResponseDTO;
use Illuminate\Support\Facades\Http;

class TestWithCachingAdjudicatorImplementation implements AdjudicatorService
{

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getVariants(): VariantsResponseDTO
    {
        $response = Http::baseUrl(config('diplomacy.adjudicator.base_url'))->get('variants');
        $response->throw();
        $dto = new VariantsResponseDTO($response->json());
        $dto->json = $response->body();

        return $dto;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function initializeGame(string $variant): AdjudicateGameResponseDTO
    {
       $json_raw = $this->do($variant, function ($data) {
            $response = Http::baseUrl(config('diplomacy.adjudicator.base_url'))->get(implode('/',
                ['adjudicate', $data]));
            $response->throw();
            return $response->body();
       });

        $dto = new AdjudicateGameResponseDTO(json_decode($json_raw, true));
        $dto->json = $json_raw;

        return $dto;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function adjudicateGame(AdjudicateGameRequestDTO $request): AdjudicateGameResponseDTO
    {
        $json_raw = $this->do($request, function($data) {
            $response = Http::baseUrl(config('diplomacy.adjudicator.base_url'))->post('adjudicate', $data->toArray());
            $response->throw();
            return $response->body();
        });

        $dto = new AdjudicateGameResponseDTO(json_decode($json_raw, true));
        $dto->json = $json_raw;

        return $dto;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getDumbbotOrders(DumbbotRequestDTO $request): DumbbotResponseDTO
    {
        $response = Http::baseUrl(config('diplomacy.adjudicator.base_url'))->post('dumbbot', $request->toArray());
        $response->throw();

        $dto = new DumbbotResponseDTO($response->json());
        $dto->json = $response->body();

        return $dto;
    }

    protected function do(mixed $data, callable $callback): string
    {
        $hash = hash("sha256", json_encode($data));
        $location = base_path('tests/cache/'.$hash.".response.json");

        if (file_exists($location)) {
            $json_raw = file_get_contents($location);
        } else {
            $json_raw = $callback($data);
            file_put_contents($location, $json_raw);
        }

        return $json_raw;
    }


}