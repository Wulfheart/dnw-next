<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class DnwClearTestAjdudicatorImplementationCacheCommand extends Command
{
    protected $signature = 'dnw:game:cache:clear';

    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $location = base_path('tests/cache/');
        $files = Finder::create()->name('*.response.json')->in($location)->files();

        foreach ($files as $file) {
            unlink($file->getRealPath());
        }

        return 0;
    }
}
