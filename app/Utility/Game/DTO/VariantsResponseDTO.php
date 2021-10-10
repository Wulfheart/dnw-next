<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class VariantsResponseDTO extends BaseDTO
{
    /** @var \App\Utility\Game\DTO\VariantDTO[] $variants */
    #[CastWith(ArrayCaster::class, itemType: VariantDTO::class)]
    public Collection $variants;
}
