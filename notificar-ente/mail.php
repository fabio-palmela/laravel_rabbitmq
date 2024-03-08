<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// MAIL_MAILER=smtp
// MAIL_DRIVER=smtp
// MAIL_HOST=sandbox.smtp.mailtrap.io
// MAIL_PORT=2525
// MAIL_USERNAME=e0e8bba51c8caa
// MAIL_PASSWORD=9f9bfd07c07bf0


// Configurações do Mailtrap
$host = 'sandbox.smtp.mailtrap.io';
$port = '2525';
$username = 'e0e8bba51c8caa';
$password = '9f9bfd07c07bf0';

// Destinatário do email
$to = 'fabio.oliveira@credicom.com.br';

// Remetente do email
$from = 'remetente@example.com';
$fromName = 'Notificador Ente';

// Assunto do email
$subject = 'Simulação de Emprestimo Consignado - RabbitMQ';

// Mensagem do email
$message = 'Foi foi foi ele.';

// Criação de uma nova instância do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuração do servidor SMTP
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use PHPMailer::ENCRYPTION_SMTPS se necessário
    $mail->Port = $port;

    // Configuração do remetente, destinatário, assunto e corpo do email
    $mail->setFrom($from, $fromName);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Envio do email
    $mail->send();
    echo 'Email enviado com sucesso!';
} catch (Exception $e) {
    echo 'Erro ao enviar o email: ', $mail->ErrorInfo;
}
?>
