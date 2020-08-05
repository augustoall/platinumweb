<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) || !isset($_POST["emp_celularkey"])) {
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

$img = new ImagensPrdInstance();
$imgBean = new ImagensPrdBean();
$imgBean = $img->c_busca_todas_imagens_prd($_POST["ID_CPF_EMPRESA"]);
$resposta["imagens_produtos"] = array();
foreach ($imgBean as $imagens) {
    $image = array();
    $image["ID_CPF_EMPRESA"] = $imagens->getID_CPF_EMPRESA();
    $image["Img_descricao"] = $imagens->getImg_descricao();
    $image["prd_descricao"] = $imagens->getPrd_descricao();
    $image["Prd_codigo"] = $imagens->getPrd_codigo();
    $image["prd_preco"] = $imagens->getPrd_preco();
    array_push($resposta["imagens_produtos"], $image);
}
echo json_encode($resposta);
?>
