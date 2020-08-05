<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) || !isset($_POST["usu_celularKey"]) || !isset($_POST["emp_celularkey"]) ) {
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

$historicoPgto = new HistoricoPgtoInstance();
$historicoPgto->c_excluirHistoricosPgto();
$resposta ["sucesso"] = 1;
echo json_encode($resposta);
?>

