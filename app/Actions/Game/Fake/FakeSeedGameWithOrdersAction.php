<?php

namespace App\Actions\Game\Fake;

use Lorisleiva\Actions\Concerns\AsAction;

class FakeSeedGameWithOrdersAction
{
    use AsAction;

    protected string $seedDir = __DIR__.'/seeds/';

    public function handle(string $seed): void
    {
    }
}
