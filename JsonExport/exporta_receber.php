<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST["rec_num_parcela"]) ||
        !isset($_POST["rec_cli_codigo"]) ||
        !isset($_POST["rec_cli_nome"]) ||
        !isset($_POST["vendac_chave"]) ||
        !isset($_POST["rec_datamovimento"]) ||
        !isset($_POST["rec_valorreceber"]) ||
        !isset($_POST["rec_datavencimento"]) ||
        !isset($_POST["rec_datavencimento_extenso"]) ||
        !isset($_POST["rec_data_que_pagou"]) ||
        !isset($_POST["rec_valor_pago"]) ||
        !isset($_POST["rec_recebeu_com"]) ||
        !isset($_POST["rec_parcelas_cartao"])) {
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
$receber = new ReceberInstance();
$receberBean = new ReceberBean();
$cliente = new ClientesInstance();
$clienteBean = new ClientesBean();

$receberBean = $receber->c_buscar_conta_receber_por_chave_e_numparcela($_POST["ID_CPF_EMPRESA"]);

// se nao existir essa parcela cadastrada inseri
if (is_null($receberBean->getVendac_chave())) {
    // inseri uma nova parcela
    $receber->c_inserir_receber_exportado($_POST["ID_CPF_EMPRESA"]);
    $resposta ["sucesso"] = 1;
    $resposta ["vendac_chave"] = trim($_POST["vendac_chave"]);
    $resposta ["rec_num_parcela"] = trim($_POST["rec_num_parcela"]);
    echo json_encode($resposta);
} else {
    // se existir a parcela apenas atualiza
    $receberBean = $receber->c_update_receber_exportado($_POST["ID_CPF_EMPRESA"]);
    $resposta ["sucesso"] = 2;
    $resposta ["vendac_chave"] = trim($_POST["vendac_chave"]);
    $resposta ["rec_num_parcela"] = trim($_POST["rec_num_parcela"]);
    echo json_encode($resposta);
}
?>
