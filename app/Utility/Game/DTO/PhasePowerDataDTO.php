<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class PhasePowerDataDTO extends BaseDTO
{
    public int $home_center_count;
    public string $power;
    public int $supply_center_count;
    public int $unit_count;
}
