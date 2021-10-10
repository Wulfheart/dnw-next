<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class UnitDTO extends BaseDTO
{
    /** @var string[] */
    public array $possible_orders;
    public string $space;
}
