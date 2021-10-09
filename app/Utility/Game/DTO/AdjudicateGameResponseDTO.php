<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class AdjudicateGameResponseDTO extends DataTransferObject
{
    /** @var \App\Utility\Game\DTO\AppliedOrderDTO[] $applied_orders */
    #[CastWith(ArrayCaster::class, itemType: AppliedOrderDTO::class)]
    public array $applied_orders;
    public string $current_state_encoded;
    public string $phase_long;

    /** @var \App\Utility\Game\DTO\PhasePowerDataDTO[] $phase_power_data */
    #[CastWith(ArrayCaster::class, itemType: PhasePowerDataDTO::class)]
    public array $phase_power_data;
    public string $phase_short;
    public string $phase_type;

    /** @var \App\Utility\Game\DTO\PossibleOrderDTO[] $possible_orders */
    #[CastWith(ArrayCaster::class, itemType: PossibleOrderDTO::class)]
    public array $possible_orders;
    public string $svg_adjudicated;
    public string $svg_with_orders;

    /** @var string[] */
    public array $winners;
    public string $winning_phase;
}
