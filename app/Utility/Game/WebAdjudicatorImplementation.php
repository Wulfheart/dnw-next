<?php

namespace App\Utility\Game;

use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\AdjudicateGameResponseDTO;
use App\Utility\Game\DTO\DumbbotRequestDTO;
use App\Utility\Game\DTO\DumbbotResponseDTO;
use App\Utility\Game\DTO\VariantsResponseDTO;
use Illuminate\Support\Facades\Http;

class WebAdjudicatorImplementation implements AdjudicatorService
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getVariants(): VariantsResponseDTO
    {
        $response = Http::log()->baseUrl(config('diplomacy.adjudicator.base_url'))->get('variants');
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
        $response = Http::log()->baseUrl(config('diplomacy.adjudicator.base_url'))->get(implode('/',
            ['adjudicate', $variant]));
        $response->throw();

        $dto = new AdjudicateGameResponseDTO($response->json());
        $dto->json = $response->body();

        return $dto;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function adjudicateGame(AdjudicateGameRequestDTO $request): AdjudicateGameResponseDTO
    {
        $response = Http::log()->baseUrl(config('diplomacy.adjudicator.base_url'))->post('adjudicate', $request->toArray());
        $response->throw();

        $dto = new AdjudicateGameResponseDTO($response->json());
        $dto->json = $response->body();

        return $dto;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getDumbbotOrders(DumbbotRequestDTO $request): DumbbotResponseDTO
    {
        $response = Http::log()->baseUrl(config('diplomacy.adjudicator.base_url'))->post('dumbbot', $request->toArray());
        $response->throw();

        $dto = new DumbbotResponseDTO($response->json());
        $dto->json = $response->body();

        return $dto;
    }
}
