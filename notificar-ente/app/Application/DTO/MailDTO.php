<?php

namespace App\Application\DTO;

use stdClass;

class MailDTO
{
    private string $to;
    private string $subject;
    private string $message;

    public function __construct(string $to, string $subject, stdClass $message)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = "Valor: {$message->valor_credito}\n";
        $this->message .= "Cooperado: {$message->cpf_cooperado}\n";
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
