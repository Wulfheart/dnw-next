<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class PossibleOrderDTO extends DataTransferObject
{
    public string $power;

    /** @var \App\Utility\Game\DTO\UnitDTO[] $units */
    #[CastWith(ArrayCaster::class, itemType: UnitDTO::class)]
    public array $units;
}
