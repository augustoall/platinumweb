<?php

// Caminho da biblioteca PHPMailer
require 'Assets/libs/phpmailer/phpmailer/PHPMailerAutoload.php';
 
// Instância do objeto PHPMailer
$mail = new PHPMailer;
 
// Configura para envio de e-mails usando SMTP
$mail->isSMTP();
 
// Servidor SMTP
$mail->Host = 'smtp.gmail.com';
 
// Usar autenticação SMTP
$mail->SMTPAuth = true;

//$mail->SMTPDebug = 2;
 
// Usuário da conta
$mail->Username = 'centralmetadevendas@gmail.com';
 
// Senha da conta
$mail->Password = 'ssspmg221242';
 
// Tipo de encriptação que será usado na conexão SMTP
$mail->SMTPSecure = 'ssl';
 
// Porta do servidor SMTP
$mail->Port = 465;
 
// Informa se vamos enviar mensagens usando HTML
$mail->IsHTML(true);
 
// Email do Remetente
$mail->From = '';
 
// Nome do Remetente
$mail->FromName = 'Paulo';
 
// Endereço do e-mail do destinatário
$mail->addAddress('');
 
// Assunto do e-mail
$mail->Subject = 'E-mail PHPMailer';
 
// Mensagem que vai no corpo do e-mail
$mail->Body = '<h1>xxxxx</h1>';
 
// Envia o e-mail e captura o sucesso ou erro
if($mail->Send()):
    echo 'Enviado com sucesso !';
else:
    echo 'Erro ao enviar Email:' . $mail->ErrorInfo;
endif;