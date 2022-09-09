<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    protected $signature = 'mail:test {email}';

    protected $description = 'Sends a test email to the specified email address';

    public function handle()
    {
        Mail::to($this->argument('email'))->send(new \App\Mail\TestMail());
        $this->info("Test email sent to {$this->argument('email')}");
        return 0;
    }
}
