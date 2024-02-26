<?php

namespace App\Infra\Broken\SimuladorService;

use App\Infra\Broken\Queue;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class SimularQueue implements Queue
{
    protected $connection;
    protected $channel;
    protected $exchange = 'credito';
    protected $queueCalcular = 'emprestimoConsignado';
    protected $routingKeyCalcular = 'simulacao.emprestimo.consignado';
    
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
        // $this->connection = new AMQPStreamConnection(
        //     env('RABBITMQ_HOST'),
        //     env('RABBITMQ_PORT'),
        //     env('RABBITMQ_LOGIN'),
        //     env('RABBITMQ_PASSWORD'),
        //     env('RABBITMQ_VHOST')
        // );
        
        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare($this->exchange, 'topic', false, true, false);
        // $this->channel->queue_declare($this->queueEmail, false, true, false, false);
        // $this->channel->queue_bind($this->queueEmail, $this->exchange, $this->routingKeyEmail);
        $this->channel->queue_declare($this->queueCalcular, false, true, false, false);
        $this->channel->queue_bind($this->queueCalcular, $this->exchange, $this->routingKeyCalcular);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);

        $this->channel->basic_publish($msg, $this->exchange, $this->routingKeyCalcular);
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