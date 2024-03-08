<?php

require 'vendor/autoload.php';
use App\Presentation\CalcularSimulacaoCommand;


$calcularConsumer = new CalcularSimulacaoCommand();
$calcularConsumer->handle();