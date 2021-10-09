<?php

namespace App\Utility\Game;

use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\AdjudicateGameResponseDTO;
use App\Utility\Game\DTO\DumbbotRequestDTO;
use App\Utility\Game\DTO\DumbbotResponseDTO;
use App\Utility\Game\DTO\VariantsResponseDTO;

interface AdjudicatorService
{
    public function getVariants(): VariantsResponseDTO;

    public function initializeGame(string $variant): AdjudicateGameResponseDTO;

    public function adjudicateGame(AdjudicateGameRequestDTO $request): AdjudicateGameResponseDTO;

    public function getDumbbotOrders(DumbbotRequestDTO $request): DumbbotResponseDTO;
}
