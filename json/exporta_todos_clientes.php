<?php

if (!isset($_POST['ID_CPF_EMPRESA']) || !isset($_POST['emp_celularkey'])) {
    $resposta["mensagem"] = "POST ERROR";
    echo json_encode($resposta);
    exit();
}

require_once '../includes/load__class__file_path_1.php';
$empresa = new EmpresaInstance();
$empBean = new EmpresaBean();
// verifica se a empresa existe e tem dias de acesso antes de fazer request
$empBean = $empresa->c_busca_empresa_por_emp_celularkey();
$dias = Util::verifica_dias_acesso($empBean);
if (is_null($empBean->getEmp_cpf()) || $dias <= 0) {
    $resposta["mensagem"] = "SEM ACESSO";
    echo json_encode($resposta);
    exit();
}



$clienteBean = new ClientesBean();
$cliente = new ClientesInstance();

$ID_CPF_EMPRESA = $_POST["ID_CPF_EMPRESA"];

$clienteBean = $cliente->C_buscarTodosClientes($ID_CPF_EMPRESA);
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
?>