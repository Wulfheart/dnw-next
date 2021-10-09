<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class AdjudicateGameRequestDTO extends DataTransferObject
{
    public string $previous_state_encoded;

    /** @var \App\Utility\Game\DTO\OrderDTO[] $orders */
    #[CastWith(ArrayCaster::class, itemType: OrderDTO::class)]
    public array $orders;
    public int $scs_to_win;
}
