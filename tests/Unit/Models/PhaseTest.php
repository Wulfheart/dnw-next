<?php

use App\Enums\GameStatusEnum;
use App\Enums\PhaseTypeEnum;
use App\Models\Phase;

it('parses the phase type correctly into the enum', function () {
    $phase = Phase::factory()->create([
        'type' => 'M',
    ]);

    expect($phase->type)->toBeInstanceOf(PhaseTypeEnum::class)
        ->and($phase->type)->toEqual(PhaseTypeEnum::MOVEMENT);
});
