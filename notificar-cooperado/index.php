<?php

require 'vendor/autoload.php';

use App\Presentation\Console\Commands\NotificaCooperadoCommand;

$notificarConsumer = new NotificaCooperadoCommand();
$notificarConsumer->handle();