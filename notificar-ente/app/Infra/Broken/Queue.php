<?php

namespace App\Infra\Broken;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

interface Queue
{
    public function connect();
    
    public function on($callback);
    
    public function publish($message);
}