<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class VariantsResponseDTO extends DataTransferObject
{
    /** @var \App\Utility\Game\DTO\VariantDTO[] $variants */
    #[CastWith(ArrayCaster::class, itemType: VariantDTO::class)]
    public array $variants;
}
