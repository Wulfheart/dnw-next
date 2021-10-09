<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class UnitDTO extends DataTransferObject
{
    /** @var string[] */
    public array $possible_orders;
    public string $space;
}
