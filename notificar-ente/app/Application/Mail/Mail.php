<?php

namespace App\Application\Mail;

interface Mail{
    public function from(string $from);
    
    public function to(string $to);
    
    public function subject(string $subject);
    
    public function message(string $message);
    
    public function send();
}