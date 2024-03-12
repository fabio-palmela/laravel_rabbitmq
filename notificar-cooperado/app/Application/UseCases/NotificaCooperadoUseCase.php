<?php
namespace App\Application\UseCases;

use App\Application\Mail\Mail;
use App\Application\DTO\MailDTO;

class NotificaCooperadoUseCase
{
    private Mail $mail;
    const SUBJECT = 'Notificação simulação cooperado';

    public function __construct($mail){
        $this->mail = $mail;
    }

    public function handle($param){
        $mailDTO = new MailDTO($param->data->mail_cooperado, self::SUBJECT, $param->data);

        $this->mail->to($mailDTO->getTo())
            ->subject($mailDTO->getSubject())
            ->message($mailDTO->getMessage())
            ->send();

        echo "O cooperado de cpf {$param->data->cpf_cooperado} foi notificado com sucesso.\n";
    }
}
