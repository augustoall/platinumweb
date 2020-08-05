<?php

session_start();
unset($_SESSION["usu_numerocelular"]);
unset($_SESSION["usu_liberado"]);
unset($_SESSION["usu_email"]);
unset($_SESSION["usu_cpf"]);
unset($_SESSION["usu_celularkey"]);
session_destroy();

//$base_url = 'https://cmdv.sistemaseapps.com.br/';
$base_url = '../index.php';

header("Location:" . $base_url);
exit();
?>
