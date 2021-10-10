<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class DumbbotResponseDTO extends BaseDTO
{
    /** @var string[] */
    public array $orders;
    public string $power;
}
