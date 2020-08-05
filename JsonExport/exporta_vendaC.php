<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST["vendac_chave"]) ||
        !isset($_POST["vendac_datahoravenda"]) ||
        !isset($_POST["vendac_previsao_entrega"]) ||
        !isset($_POST["vendac_usu_codigo"]) ||
        !isset($_POST["vendac_usu_nome"]) ||
        !isset($_POST["vendac_cli_codigo"]) ||
        !isset($_POST["vendac_cli_nome"]) ||
        !isset($_POST["vendac_fpgto_codigo"]) ||
        !isset($_POST["vendac_fpgto_tipo"]) ||
        !isset($_POST["vendac_valor"]) ||
        !isset($_POST["vendac_peso_total"]) ||
        !isset($_POST["vendac_observacao"]) ||
        !isset($_POST["vendac_latitude"]) ||
        !isset($_POST["vendac_longitude"])) {
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
$vendaC = new VendaInstance();
$vendaCBean = new VendacBean();
$vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave($_POST["ID_CPF_EMPRESA"], $_POST["vendac_chave"]);

if (is_null($vendaCBean->getVendac_chave())) {
    $vendaC->c_recebe_venda_do_android();
    $resposta ["sucesso"] = 1;
    $resposta ["vendac_chave"] = trim($_POST["vendac_chave"]);
    echo json_encode($resposta);
} else {
    $resposta ["sucesso"] = 2;
    $resposta ["mensagem"] = "nao ha vendas novas a serem exportadas";
    echo json_encode($resposta);
}
?>
