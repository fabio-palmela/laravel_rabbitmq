<?php

namespace App\Infra\Broken;

use App\Infra\Broken\Queue;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class EmailQueue implements Queue
{
    protected $connection;
    protected $channel;
    protected $exchange_consumer = 'credito';
    protected $queue_consumer = 'email';
    protected $routingKey_consumer = 'notificar.consignado.cooperado.*';

    // protected $exchange_consumer = 'credito';
    // protected $queue_consumer = 'email';
    // protected $routingKey_consumer = 'notificar.consignado.cooperado.email';

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

        $this->channel->exchange_declare($this->exchange_consumer, 'topic', false, true, false);
        $this->channel->queue_declare($this->queue_consumer, false, true, false, false);
        $this->channel->queue_bind($this->queue_consumer, $this->exchange_consumer, $this->routingKey_consumer);
    }

    public function publish($message)
    {
        // $msg = new AMQPMessage($message);

        // $this->channel->basic_publish($msg, $this->exchange_consumer, $this->routingKey);
    }

    public function on($callback)
    {
        $this->channel->basic_consume($this->queue_consumer, '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function acknowledge($msg)
    {
        dd($msg->delivery_info['delivery_tag']);
        $this->channel->basic_ack($msg->delivery_info['delivery_tag']);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}