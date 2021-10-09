<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class DumbbotResponseDTO extends DataTransferObject
{
    /** @var string[] */
    public array $orders;
    public string $power;
}
