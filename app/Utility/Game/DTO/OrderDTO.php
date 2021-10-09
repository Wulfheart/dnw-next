<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class OrderDTO extends DataTransferObject
{
    public string $power;

    /** @var string[] */
    public array $instructions;
}
