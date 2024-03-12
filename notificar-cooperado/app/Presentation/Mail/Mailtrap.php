<?php

namespace App\Presentation\Mail;

use App\Application\Mail\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailtrap implements Mail{
    private $mail;
    private mail$host;
    private $port;
    private $username;
    private $password;
    private $to;
    private $from;
    private $fromName;
    private $subject;
    private $message;
    function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use PHPMailer::ENCRYPTION_SMTPS se necessário
        $this->mail->Host = 'sandbox.smtp.mailtrap.io';
        $this->mail->Port = '2525';
        $this->mail->Username = 'e0e8bba51c8caa';
        $this->mail->Password = '9f9bfd07c07bf0';
        $this->from();
    }

    public function from($from = 'remetente@example.com', $fromName = 'Name remetente'){
        $this->from = $from;
        $this->fromName = $fromName;

        $this->mail->setFrom($from, $fromName);
    }
    
    public function to(string $to){
        if (!$to)
            throw new Exception('Necessário endereço de destino.');
        $this->to = $to;
        return $this;
    }
    
    public function subject(string $subject){
        if (!isset($subject))
            throw new Exception('Assunto é necessário.');

        $this->subject = $subject;
        $this->mail->Subject = $subject;
        return $this;
    }
    
    public function message(string $message){
        if (!isset($message))
            throw new Exception('Mensagem é necessária.');

        $this->message = $message;
        $this->mail->Body = $message;
        return $this;
    }
    
    public function send(){
        $this->mail->addAddress($this->to);
        $this->mail->send();
    }
}