<?php
//echo 'voce precisa configurar seu arquivo esqueciminhasenha.php  para enviar emails';
//exit();


session_start();
require_once '../includes/load__class__file_path_1.php';
require_once './Assets/libs/phpmailer/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

if ($_POST) {



    $usuario = new UsuariosInstance();
    $usuBean = new UsuariosBean();
    $usuBean = $usuario->c_buscar_email_esqueci_minha_senha();

    // use  $usuBean->getUsu_cpf() para enviar a senha pro usuario 

    if (!is_null($usuBean->getUsu_email())) {

        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->addAddress($usuBean->getUsu_email(), $usuBean->getUsu_nome());
        $mail->FromName = ""; // Seu nome
        $mail->Subject = ''; // Assunto da mensagem
        $mail->Port = 587;
        $mail->Host = ''; // ex: smtp.seudominio.com.br
        $mail->Username = ''; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = ''; // Senha do servidor SMTP (senha do email usado)
        $mail->From = ''; // Seu e-mail
        $mail->Sender = '';  // Seu e-mail
        //$mail->SMTPDebug = 1;
        $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->IsHTML(true);


        $msg = '<body style="margin:0px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="25" style="background-color:#eee; margin:0px;"><tbody><tr><td height="331" valign="top">
                    <table width="90%" border="0" align="center" cellpadding="30" style="background-color:#FFFFFF;"><tbody><tr><td>                         
                        <h3>Recuperação da senha</h3>                          
                        <p><h4>Usuário: ' . $usuBean->getUsu_usuario() . '</h4></p>
                        <p><h4>Senha: ' . $usuBean->getUsu_cpf() . ' </h4></p>
                    </td></tr></tbody></table>
            </td></tr></tbody></table>';
        $mail->Body = $msg;

        /*
          // usando smtpconnect com a locaweb
          $mail->smtpConnect([
          'ssl' => [
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          ]
          ]);
         * 
         */

        if (!$mail->send()) {
            echo 'NAO FOI POSSIVEL ENVIAR O EMAIL DE' . $usuBean->getUsu_usuario();
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } ELSE {
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Login Central Meta de Vendas</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sign.css" rel="stylesheet">
        <link href="css/blog.css" rel="stylesheet">        
    </head>

    <body>
        <div class="container">

            <form class="form-signin" role="form" action="esqueciminhasenha.php" method="POST">
                <h5>configure seu arquivo esqueciminhasenha.php para envio de emails </h5>
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" name="usu_email" id="inputEmail" class="form-control"  placeholder="Email" required autofocus>

                <button class="btn btn-lg btn-default btn-block" type="submit">enviar minha senha</button>
                <button type="button" class="btn  btn-default btn-block" value="" onClick="location.href = '../index.php'"><i class="icon-search "></i>voltar</button>



            </form>


        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
