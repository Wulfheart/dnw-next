<?php

namespace App\Utility\Game\DTO;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class OrderDTO extends BaseDTO
{
    public string $power;

    /** @var string[] $instructions */
    public array $instructions;
}
