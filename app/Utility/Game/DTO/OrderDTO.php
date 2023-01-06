<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class OrderDTO extends BaseDTO
{
    public string $power;

    /** @var string[] */
    public array $instructions;
}
