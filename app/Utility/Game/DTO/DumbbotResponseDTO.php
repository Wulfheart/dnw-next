<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class DumbbotResponseDTO extends BaseDTO
{
    /** @var string[] */
    public array $orders;

    public string $power;
}
