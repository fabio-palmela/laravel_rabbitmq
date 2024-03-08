<?php

namespace App\Infra\Broken\NotificaEnteService;

use App\Infra\Broken\Queue;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class EmailEnteConsignanteConsumer implements Queue
{
    protected $connection;
    protected $channel;
    protected $exchange_consumer = 'credito';
    protected $queue_consumer = 'emprestimoConsignadoEnte';
    protected $routingKey_consumer = 'emprestimo.consignado.#';
    
    public function __construct()
    {
        $this->connect();        
    }
    
    public function connect(){
        $this->connection = new AMQPStreamConnection(
            '127.0.0.1',
            '5672',
            'guest',
            'guest',
            '/'
        );
        
        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare($this->exchange_consumer, 'topic', false, true, false);
        $this->channel->queue_declare($this->queue_consumer, false, true, false, false);
        $this->channel->queue_bind($this->queue_consumer, $this->exchange_consumer, $this->routingKey_consumer);
    }

    public function publish($message)
    {
        
    }

    public function on($callback = null)
    {
        $auto_ack = false;
        $this->channel->basic_consume($this->queue_consumer, '', false, $auto_ack, false, false, $callback);
        
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