<?php

namespace App\Infra\Broken\CalcularEmprestimoService;

use App\Infra\Broken\Queue;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class EmailEnteConsignanteQueue implements Queue
{
    protected $connection;
    protected $channel;
    protected $exchange_producer = 'credito';
    protected $queue_producer = 'notificaEnteConsignante';
    protected $routingKey_producer = 'notificar.enteconsignante.mail';
    
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

        $this->channel->exchange_declare($this->exchange_producer, 'topic', false, true, false);
        $this->channel->queue_declare($this->queue_producer, false, true, false, false);
        $this->channel->queue_bind($this->queue_producer, $this->exchange_producer, $this->routingKey_producer);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);

        $this->channel->basic_publish($msg, $this->exchange_producer, $this->routingKey_producer);
    }

    public function on($callback)
    {
        // $this->channel->basic_consume($this->queue, '', false, true, false, false, $callback);

        // while ($this->channel->is_consuming()) {
        //     $this->channel->wait();
        // }
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