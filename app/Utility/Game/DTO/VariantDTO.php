<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class VariantDTO extends BaseDTO
{
    public int $default_end_of_game;
    public string $name;

    /** @var string[] */
    public array $powers;
}
