<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Presentation\Mail\Gmail;
use App\Presentation\Mail\YahooMail;


class TesteMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:teste';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userEmail = 'fabiopalmeladeoliveira@gmail.com';
        \Illuminate\Support\Facades\Mail::to($userEmail)->send(new Gmail());
    }
}
