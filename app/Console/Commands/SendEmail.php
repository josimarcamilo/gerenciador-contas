<?php

namespace App\Console\Commands;

use App\Mail\MailTest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Mail::to('josimarifmg@gmail.com')->send(new MailTest());

        $this->info('Email send success');
    }
}
