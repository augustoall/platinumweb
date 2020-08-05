<?php

if (!isset($_POST["emp_celularkey"])) {
    $resposta["mensagem"] = "erro";
    echo json_encode($resposta);
    exit();
}

require_once '../includes/load__class__file_path_1.php';
$usuario = new UsuariosInstance();
$usuarioBean = new UsuariosBean();
$usuarioBean = $usuario->c_busca_dados_vendedor();

if (is_null($usuarioBean->getUsu_codigo())) {
    $resposta["mensagem"] = "erro emp_celularkey nao existe ou nao liberado";
    echo json_encode($resposta);
    exit();
}


$resposta["usuario_array"] = array();
$c = array();
$c["usu_codigo"] = $usuarioBean->getUsu_codigo();
$c["nome_vendedor"] = $usuarioBean->getUsu_nome();
$c["usu_desconto"] = $usuarioBean->getUsu_desconto();
array_push($resposta["usuario_array"], $c);
echo json_encode($resposta);
