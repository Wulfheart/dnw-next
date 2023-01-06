<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class VariantDTO extends BaseDTO
{
    public int $default_end_of_game;

    public string $name;

    /** @var string[] */
    public array $powers;
}
