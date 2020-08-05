<?php

error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST['emp_cpf'])) {

    require_once '../includes/load__class__file_path_1.php';

    $clienteBean = new ClientesBean();
    $cliente = new ClientesInstance();

    $ID_CPF_EMPRESA = $_POST["emp_cpf"];
    $usu_codigo = $_POST["usu_codigo"];

    $clienteBean = $cliente->C_buscaClientesDoVendedorUsuario($ID_CPF_EMPRESA, $usu_codigo);
    $resposta["clientes_array"] = array();
    foreach ($clienteBean as $cli) {

        $c = array();
        $c["ID_CPF_EMPRESA"] = $cli->getID_CPF_EMPRESA();
        $c["cli_codigo"] = $cli->getCli_codigo();
        $c["cli_nome"] = $cli->getCli_nome();
        $c["cli_fantasia"] = $cli->getCli_fantasia();
        $c["cli_endereco"] = $cli->getCli_endereco();
        $c["cli_bairro"] = $cli->getCli_bairro();
        $c["cli_cep"] = $cli->getCli_cep();
        $c["usu_codigo"] = $cli->getUsu_codigo();
        $c["cid_codigo"] = $cli->getCid_codigo();
        $c["cli_contato1"] = $cli->getCli_contato1();
        $c["cli_contato2"] = $cli->getCli_contato2();
        $c["cli_contato3"] = $cli->getCli_contato3();
        $c["cli_nascimento"] = $cli->getCli_nascimento();
        $c["cli_cpfcnpj"] = $cli->getCli_cpfcnpj();
        $c["cli_rginscricaoest"] = $cli->getCli_rginscricaoest();
        $c["cli_observacao"] = $cli->getCli_observacao();
        $c["cli_limite"] = $cli->getCli_limite();
        $c["cli_email"] = $cli->getCli_email();
        $c["cli_senha"] = $cli->getCli_senha();
        $c["cli_chave"] = $cli->getCli_chave();
        array_push($resposta["clientes_array"], $c);
    }
    echo json_encode($resposta);
} else {
    $resposta["clientes_array"] = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>