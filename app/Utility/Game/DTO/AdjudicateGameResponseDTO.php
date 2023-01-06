<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Casters\ArrayCaster;

#[Strict]
class AdjudicateGameResponseDTO extends BaseDTO
{
    /** @var \App\Utility\Game\DTO\AppliedOrderDTO[] $applied_orders */
    #[CastWith(ArrayCaster::class, itemType: AppliedOrderDTO::class)]
    public Collection $applied_orders;

    public string $current_state_encoded;

    public string $phase_long;

    /** @var \App\Utility\Game\DTO\PhasePowerDataDTO[] $phase_power_data */
    #[CastWith(ArrayCaster::class, itemType: PhasePowerDataDTO::class)]
    public Collection $phase_power_data;

    public string $phase_short;

    public string $phase_type;

    /** @var \App\Utility\Game\DTO\PossibleOrderDTO[] $possible_orders */
    #[CastWith(ArrayCaster::class, itemType: PossibleOrderDTO::class)]
    public Collection $possible_orders;

    public string $svg_adjudicated;

    public string $svg_with_orders;

    /** @var string[] */
    public array $winners;

    public string $winning_phase;
}
