<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class VariantDTO extends DataTransferObject
{
    public int $default_end_of_game;
    public string $name;

    /** @var string[] */
    public array $powers;
}
