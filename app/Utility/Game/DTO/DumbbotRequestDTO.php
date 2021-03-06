<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class DumbbotRequestDTO extends BaseDTO
{
    public string $current_state_encoded;
    public string $power;
}
