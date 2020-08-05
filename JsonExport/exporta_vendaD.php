<?php

//******************************************************************
//############################  VALIDA ACESSO ######################
if (!isset($_POST["ID_CPF_EMPRESA"]) ||
        !isset($_POST["emp_celularkey"]) ||
        !isset($_POST["vendac_chave"]) ||
        !isset($_POST["vendad_nro_item"]) ||
        !isset($_POST["vendad_ean"]) ||
        !isset($_POST["vendad_codigo_produto"]) ||
        !isset($_POST["vendad_descricao_produto"]) ||
        !isset($_POST["vendad_quantidade"]) ||
        !isset($_POST["vendad_precovenda"]) ||
        !isset($_POST["vendad_total"])) {
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

$prodBean = new ProdutoBean();
$produto = new ProdutosInstance();
$resposta = array();
$vendaD = new VendaInstance();
$vendaDBean = new VendadBean();
$vendaDBean = $vendaD->c_buscar_itens_da_venda_por_vendac_chave_e_codigoProduto($_POST["ID_CPF_EMPRESA"], $_POST["vendac_chave"], $_POST["vendad_codigo_produto"]);

$item_da_venda = count($vendaDBean);

if ($item_da_venda <= 0) {
    $vendaD->c_inserir_vendad(); // estoque alterado por trigguer e stored procedure
    $resposta ["sucesso"] = 1;
    $resposta ["vendac_chave"] = trim($_POST["vendac_chave"]);
    echo json_encode($resposta);
} else {
    $resposta ["sucesso"] = 2;
    $resposta ["mensagem"] = "nao ha items novos a serem exmportados";
    echo json_encode($resposta);
}
?>
