<?php
namespace App\Application\UseCases;

use App\Application\Mail\Mail;
use App\Application\DTO\MailDTO;

class NotificaEnteUseCase
{
    private Mail $mail;
    const SUBJECT = 'Simulação de consignado';

    public function __construct($mail){
        $this->mail = $mail;
    }

    public function handle($data){
        $enteMail = 'credicom@credicom.com.br';
        $msg = json_encode($data);

        $mailDTO = new MailDTO($data->mail_ente_consignante, self::SUBJECT, $data);

        $this->mail->to($mailDTO->getTo())
            ->subject($mailDTO->getSubject())
            ->message($mailDTO->getMessage())
            ->send();
        // \Illuminate\Support\Facades\Mail::to($userEmail)->send(new SimulacaoEmprestimoConsignadoMail($data));
        echo "Ente consignante {$enteMail} notificado com sucesso.\n";
    }
}
