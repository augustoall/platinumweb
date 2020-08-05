<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST ['ID_CPF_EMPRESA']) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST ['chq_codigo']) ||
        !isset($_POST ['chq_cli_codigo']) ||
        !isset($_POST ['chq_numerocheque']) ||
        !isset($_POST ['chq_telefone1']) ||
        !isset($_POST ['chq_telefone2']) ||
        !isset($_POST ['chq_cpf_dono']) ||
        !isset($_POST ['chq_nomedono']) ||
        !isset($_POST ['chq_nomebanco']) ||
        !isset($_POST ['chq_vencimento']) ||
        !isset($_POST ['chq_valorcheque']) ||
        !isset($_POST ['chq_terceiro']) ||
        !isset($_POST ['vendac_chave']) ||
        !isset($_POST ['chq_dataCadastro'])) {
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
$cheque = new ChequesInstance();
$chq = new ChequesBean();

$chq = $cheque->c_busca_cheque_por_vendac_chave($_POST["ID_CPF_EMPRESA"], $_POST["vendac_chave"]);

if (is_null($chq->getVendac_chave())) {

    $cheque->c_inserir_cheque_exportado();
    $resposta ["sucesso"] = 1;
    $resposta ["mensagem"] = "cheque " . $_POST["vendac_chave"] . " exportado";
    echo json_encode($resposta);
} else {
    $resposta ["sucesso"] = 2;
    $resposta ["mensagem"] = "cheque ja foi exportado";
    echo json_encode($resposta);
}
?>
