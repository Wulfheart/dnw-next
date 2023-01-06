<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class AppliedOrderDTO extends BaseDTO
{
    /** @var string[] */
    public array $orders;

    public string $power;
}
