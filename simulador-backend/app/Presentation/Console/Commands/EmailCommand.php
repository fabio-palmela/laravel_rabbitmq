<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Infra\Broken\EmailQueue;
use App\Infra\Broken\SimularQueue;
use App\Infra\Broken\RabbitMQService;
use App\Application\UseCases\EmailUseCase;
use App\Application\UseCases\SimularUseCase;

class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email';

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
        $callback = function ($msg) {
            $data = json_decode($msg->body);
            $simularUseCase = new EmailUseCase();
            $simularUseCase->send($data);
        };
        $simularQueue = new EmailQueue();
        $simularQueue->on($callback);
    }
}
