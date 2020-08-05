<?php


if (isset($_POST['emp_cpf'])) {


    require_once '../includes/load__class__file_path_1.php';

    $produtos = new ProdutosInstance();

    $ID_CPF_EMPRESA = $_POST["emp_cpf"];

    $p = $produtos->C_buscarTodosProdutos_ATIVOS($ID_CPF_EMPRESA);



    $resposta["produtos_array"] = array();
    foreach ($p as $prodBean) {

        $c = array();
        $c["prd_codigo"] = $prodBean->getPrd_codigo();
        $c["prd_EAN"] = $prodBean->getPrd_EAN();
        $c["prd_descricao"] = $prodBean->getPrd_descricao();
        $c["prd_descr_red"] = $prodBean->getPrd_descr_red();
        $c["prd_unmed"] = $prodBean->getPrd_unmed();
        $c["prd_custo"] = $prodBean->getPrd_custo();
        $c["prd_preco"] = $prodBean->getPrd_preco();
        $c["prd_quant"] = $prodBean->getPrd_quant();
        $c["cat_descricao"] = $prodBean->getCat_descricao();


        array_push($resposta["produtos_array"], $c);
    }


    echo json_encode($resposta);
} else {
    $resposta["produtos_array"] = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>
