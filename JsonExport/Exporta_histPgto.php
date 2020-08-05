<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST["hist_codigo"]) ||
        !isset($_POST["hist_numero_parcela"]) ||
        !isset($_POST["hist_valor_real_parcela"]) ||
        !isset($_POST["hist_valor_pago_no_dia"]) ||
        !isset($_POST["hist_restante_a_pagar"]) ||
        !isset($_POST["hist_datapagamento"]) ||
        !isset($_POST["hist_nomecliente"]) ||
        !isset($_POST["hist_pagou_com"]) ||
        !isset($_POST["vendac_chave"]) ||
        !isset($_POST["usu_celularkey"])) {
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
$historicoPgto = new HistoricoPgtoInstance();

$hist = $historicoPgto->c_inserir_historicoPgto_exportado();

if ($hist) {
    $resposta ["sucesso"] = 1;
    echo json_encode($resposta);
} else {
    $resposta ["sucesso"] = 2;
    echo json_encode($resposta);
}
?>

