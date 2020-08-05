<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST["pag_sementrada_comentrada"]) ||
        !isset($_POST["pag_tipo_pagamento"]) ||
        !isset($_POST["pag_recebeucom_din_chq_cart"]) ||
        !isset($_POST["pag_valor_recebido"]) ||
        !isset($_POST["pag_parcelas_normal"]) ||
        !isset($_POST["pag_parcelas_cartao"]) ||
        !isset($_POST["vendac_chave"])) {
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
$confpagBean = new confPagamentoBean();
$confpag = new ConfPagamentoInstace();
$confpagBean = $confpag->c_buscar_confpagamento_por_chave($_POST["ID_CPF_EMPRESA"], $_POST["vendac_chave"]);

if (is_null($confpagBean->getVendac_chave())) {
    $confpag->c_inserir_conf_pagamento_exportado($_POST["ID_CPF_EMPRESA"]);
    $resposta ["sucesso"] = 1;
    $resposta ["vendac_chave"] = trim($_POST["vendac_chave"]);
    echo json_encode($resposta);
} else {

    $resposta ["sucesso"] = 2;
    echo json_encode($resposta);
}
?>

