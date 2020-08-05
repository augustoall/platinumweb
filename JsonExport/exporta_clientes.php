<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST ['ID_CPF_EMPRESA']) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST ['codigo_do_cliente']) ||
        !isset($_POST ['cli_nome']) ||
        !isset($_POST ['cli_fantasia']) ||
        !isset($_POST ['cli_endereco']) ||
        !isset($_POST ['cli_bairro']) ||
        !isset($_POST ['cli_cep']) ||
        !isset($_POST ['cid_codigo']) ||
        !isset($_POST ['cli_contato1']) ||
        !isset($_POST ['cli_contato2']) ||
        !isset($_POST ['cli_contato3']) ||
        !isset($_POST ['cli_nascimento']) ||
        !isset($_POST ['cli_cpfcnpj']) ||
        !isset($_POST ['cli_rginscricaoest']) ||
        !isset($_POST ['cli_limite']) ||
        !isset($_POST ['cli_email']) ||
        !isset($_POST ['cli_observacao']) ||
        !isset($_POST ['usu_codigo']) ||
        !isset($_POST ['cli_senha']) ||
        !isset($_POST ['cli_chave'])) {
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
// PASSOU NAS VALIDACOES PODE FAZER REQUEST
//******************************************************************
//******************************************************************

$resposta = array();
$cliente = new ClientesInstance ();
$clienteBean = new ClientesBean ();

$ID_CPF_EMPRESA = $_POST ["ID_CPF_EMPRESA"];
$codigo_do_cliente = $_POST ['codigo_do_cliente'];

$clienteBean = $cliente->C_buscaClientePorCodigo($ID_CPF_EMPRESA, $codigo_do_cliente);

if (!is_null($clienteBean->getCli_codigo())) {
    $cliente->c_alterar_cliente_exportado($ID_CPF_EMPRESA);
    $resposta["sucesso"] = 1;
    echo json_encode($resposta);    
}

if (is_null($clienteBean->getCli_codigo())) {
    $lastInsertId = $cliente->c_grava_cliente($ID_CPF_EMPRESA);    
    $resposta ["codigo_off_line"] = $codigo_do_cliente;
    $resposta ["novo_codigo"] = $lastInsertId;
    $resposta["sucesso"] = 2;
    echo json_encode($resposta);
}
?>

