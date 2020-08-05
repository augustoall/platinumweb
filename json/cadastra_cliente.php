<?php

if (!isset($_POST['emp_celularkey']) ||
        !isset($_POST['cli_nome']) ||
        !isset($_POST['cli_fantasia']) ||
        !isset($_POST['cli_endereco']) ||
        !isset($_POST['cli_bairro']) ||
        !isset($_POST['cli_cep']) ||
        !isset($_POST['cid_codigo']) ||
        !isset($_POST['cli_contato1']) ||
        !isset($_POST['cli_contato2']) ||
        !isset($_POST['cli_contato3']) ||
        !isset($_POST['cli_nascimento']) ||
        !isset($_POST['cli_cpfcnpj']) ||
        !isset($_POST['cli_rginscricaoest']) ||
        !isset($_POST['cli_limite']) ||
        !isset($_POST['cli_email']) ||
        !isset($_POST['cli_observacao']) ||
        !isset($_POST['usu_codigo']) ||
        !isset($_POST['cli_senha']) ||
        !isset($_POST['cli_chave']) ||
        !isset($_POST['ID_CPF_EMPRESA'])) {
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


$ID_CPF_EMPRESA = $_POST["ID_CPF_EMPRESA"];

$cliente = new ClientesInstance();
$clienteBean = new ClientesBean();
$lastInsertId = $cliente->c_grava_cliente($ID_CPF_EMPRESA);

if ($lastInsertId <= 0) {
    $resposta["sucesso"] = 0;
    $resposta["mensagem"] = "erro ao recuperar o lastInsertId do cliente gravado";
    echo json_encode($resposta);
}


if ($lastInsertId > 0) {
    // busca o cliente que foi gravado atraves do $lastInsertId
    $clienteBean = $cliente->C_buscaClientePorCodigo($ID_CPF_EMPRESA, $lastInsertId);
    $resposta["cli_array"] = array();

    $c = array();
    $c["ID_CPF_EMPRESA"] = $clienteBean->getID_CPF_EMPRESA();
    $c["cli_codigo"] = $clienteBean->getCli_codigo();
    $c["cli_nome"] = $clienteBean->getCli_nome();
    $c["cli_fantasia"] = $clienteBean->getCli_fantasia();
    $c["cli_endereco"] = $clienteBean->getCli_endereco();
    $c["cli_bairro"] = $clienteBean->getCli_bairro();
    $c["cli_cep"] = $clienteBean->getCli_cep();
    $c["usu_codigo"] = $clienteBean->getUsu_codigo();
    $c["cid_codigo"] = $clienteBean->getCid_codigo();
    $c["cli_contato1"] = $clienteBean->getCli_contato1();
    $c["cli_contato2"] = $clienteBean->getCli_contato2();
    $c["cli_contato3"] = $clienteBean->getCli_contato3();
    $c["cli_nascimento"] = $clienteBean->getCli_nascimento();
    $c["cli_cpfcnpj"] = $clienteBean->getCli_cpfcnpj();
    $c["cli_rginscricaoest"] = $clienteBean->getCli_rginscricaoest();
    $c["cli_observacao"] = $clienteBean->getCli_observacao();
    $c["cli_limite"] = $clienteBean->getCli_limite();
    $c["cli_email"] = $clienteBean->getCli_email();
    $c["cli_senha"] = $clienteBean->getCli_senha();
    $c["cli_chave"] = "";
    array_push($resposta["cli_array"], $c);  
    echo json_encode($resposta);
}
?>

