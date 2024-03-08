<?php

require 'vendor/autoload.php';

use App\Presentation\Console\Commands\NotificaEnteConsignanteCommand;

$notificarConsumer = new NotificaEnteConsignanteCommand();
$notificarConsumer->handle();