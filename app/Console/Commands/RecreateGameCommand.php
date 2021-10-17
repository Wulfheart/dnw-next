<?php

namespace App\Console\Commands;

use App\Utility\Game\GameRecreator;
use Illuminate\Console\Command;

class RecreateGameCommand extends Command
{
    protected $signature = 'dnw:recreate';

    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        app(GameRecreator::class)->createFromFolder('5ddc2830-fa23-4a0d-9a78-ccb06ccab2bb');
    }
}
