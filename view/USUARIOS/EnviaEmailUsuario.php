<?php

ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$usuario = new Usuarios();
$usuario->C_buscaUsuarioPorCodigo($ID_CPF_EMPRESA);

//1 – Definimos Para quem vai ser enviado o email
$para = $usuario->getUsu_email();
//2 - resgatar o nome digitado no formulário e  grava na variavel $nome
$nome = "CENTRAL META DE VENDAS";
// 3 - resgatar o assunto digitado no formulário e  grava na variavel //$assunto
$assunto = "[ LOGIN C.M.D.V ]";
//4 – Agora definimos a  mensagem que vai ser enviado no e-mail
$mensagem = "<strong>Nome:  </strong>" . $nome;
$mensagem .= "<br><strong>Mensagem: </strong>" . " Este é seu login de acesso ao sistema ";
$mensagem .= "<br>";
$mensagem .= "<br>";
$mensagem .= "<br>  <strong>Login : </strong>" . $usuario->getUsu_email();
$mensagem .= "<br>  <strong>Senha : </strong>" . $usuario->getUsu_cpf();
echo '<br/>';
echo '<br/>';
//5 – agora inserimos as codificações corretas e  tudo mais.
$headers = "Content-Type:text/html; charset=UTF-8\n";
$headers .= "From:  dominio.com.br<sistema@dominio.com.br>\n"; //Vai ser //mostrado que  o email partiu deste email e seguido do nome
$headers .= "X-Sender:  <sistema@dominio.com.br>\n"; //email do servidor //que enviou
$headers .= "X-Mailer: PHP  v" . phpversion() . "\n";
$headers .= "X-IP:  " . $_SERVER['REMOTE_ADDR'] . "\n";
$headers .= "Return-Path:  <sistema@dominio.com.br>\n"; //caso a msg //seja respondida vai para  este email.
$headers .= "MIME-Version: 1.0\n";
echo '<br/>';
echo '<br/>';
echo $headers;
echo '<br/>';
echo $para;
echo $assunto;
echo '<br/>';
echo $mensagem;

//mail($para, $assunto, $mensagem, $headers);  //função que faz o envio do email.
?>