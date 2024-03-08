<?php

namespace App\Infra\Broken;

use App\Infra\Broken\Queue;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AtualizaMargemQueue implements Queue
{
    protected $connection;
    protected $channel;
    protected $exchange = 'credito';
    protected $queue = 'margem_cooperado';
    protected $routingKey = 'emprestimo.consignado.margem.atualizada';
    
    public function __construct()
    {
        $this->connect();        
    }
    
    public function connect(){
        $this->connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.login'),
            config('rabbitmq.password'),
            config('rabbitmq.vhost')
        );
        
        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare($this->exchange, 'topic', false, true, false);
        $this->channel->queue_declare($this->queue, false, true, false, false);
        $this->channel->queue_bind($this->queue, $this->exchange, $this->routingKey);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);

        $this->channel->basic_publish($msg, $this->exchange, $this->routingKey);
    }

    public function on($callback = null)
    {
        $auto_ack = false;
        $this->channel->basic_consume($this->queue, '', false, $auto_ack, false, false, $callback);
        
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function acknowledge($msg)
    {
        $this->channel->basic_ack($msg->delivery_info['delivery_tag']);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}