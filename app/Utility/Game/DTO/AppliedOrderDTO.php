<?php

namespace App\Utility\Game\DTO;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class AppliedOrderDTO extends DataTransferObject
{
    /** @var string[] */
    public array $orders;
    public string $power;
}
