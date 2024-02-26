<?php

namespace App\Presentation\Console\Commands\AppGenerica;

use Illuminate\Console\Command;
use App\Infra\Broken\AppGenerica\SimulacoesQueue;

class SimulacoesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:simulacoes';

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
        $simulacoesQueue = new SimulacoesQueue();
        $callback = function ($msg) use ($simulacoesQueue){
            echo $msg->body;
            $data = json_decode($msg->body);
            $simulacoesQueue->acknowledge($msg);
        };
        
        $simulacoesQueue->on($callback);
    }
}
