<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class UnitDTO extends BaseDTO
{
    /** @var string[] */
    public array $possible_orders;

    public string $space;
}
