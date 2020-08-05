<?php

ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$acao = (isset($_POST["acao"])) ? filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING) : ((isset($_GET["acao"])) ? filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING) : 0 );
$parametro = (isset($_POST["parametro"])) ? filter_input(INPUT_POST, 'parametro', FILTER_SANITIZE_STRING) : ((isset($_GET["parametro"])) ? filter_input(INPUT_GET, 'parametro', FILTER_SANITIZE_STRING) : 0 );
$entrada_produto = new EntradaProdutoInstance();


switch ($acao) {

    case 'GERAR_NOTA_DE_ENTRADA':

        $ID_CPF_EMPRESA = filter_input(INPUT_POST, 'ID_CPF_EMPRESA', FILTER_SANITIZE_STRING);
        date_default_timezone_set('America/Sao_Paulo');
        $ent_numeronota = filter_input(INPUT_POST, 'ent_numeronota', FILTER_SANITIZE_STRING);
        $ent_data_entrada = filter_input(INPUT_POST, 'ent_data_entrada', FILTER_SANITIZE_STRING);
        $ent_valor_nota = $_POST["ent_valor_nota"];
        $usu_codigo = filter_input(INPUT_POST, 'usu_codigo', FILTER_SANITIZE_NUMBER_INT);
        $for_codigo = filter_input(INPUT_POST, 'for_codigo', FILTER_SANITIZE_NUMBER_INT);

        // verifica se a nota ja foi adicionada
        $entBean = $entrada_produto->c_busca_numeronota($ID_CPF_EMPRESA, $ent_numeronota);

        if ($entBean["ent_numeronota"] == NULL) {
            if ($ent_id = $entrada_produto->c_grava_entrada_produto($ID_CPF_EMPRESA, $ent_numeronota, $ent_data_entrada, $ent_valor_nota, $usu_codigo, $for_codigo)) {
                echo $ent_id;
            } else {
                echo 0;
            }
        } else {
            echo 'NOTAEXISTENTE';
        }
        break;

    case 'GRAVAR_ITENS':

        $ID_CPF_EMPRESA = filter_input(INPUT_POST, 'ID_CPF_EMPRESA', FILTER_SANITIZE_STRING);
        $ent_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $entd_ean = filter_input(INPUT_POST, 'entd_ean', FILTER_SANITIZE_STRING);
        $entd_prd_codigo = filter_input(INPUT_POST, 'entd_prd_codigo', FILTER_SANITIZE_NUMBER_INT);
        $entd_descricaoprd = filter_input(INPUT_POST, 'entd_descricaoprd', FILTER_SANITIZE_STRING);
        $entd_qtd = $_POST["entd_qtd"];
        $entd_custo = $_POST["entd_custo"];
        $entd_margem = $_POST["entd_margem"];
        $entd_preco = $_POST["entd_preco"];

        // verifica item ja adicionado
        $entBean = $entrada_produto->c_busca_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo);

        if ($entBean["entd_prd_codigo"] == NULL) {
            if ($entrada_produto->c_grava_itens_entrada_produtos_D($ID_CPF_EMPRESA, $ent_id, $entd_ean, $entd_prd_codigo, $entd_descricaoprd, $entd_custo, $entd_qtd, $entd_margem, $entd_preco)) {
                echo $ent_id;
            } else {
                echo 0;
            }
        } else {
            echo 'ITEM_JA_ADICIONADO';
        }
        break;

    case 'BUSCAR_ITENS_DA_NOTA':

        $ent_id = filter_input(INPUT_POST, 'ent_id', FILTER_SANITIZE_NUMBER_INT);
        $ID_CPF_EMPRESA = filter_input(INPUT_POST, 'ID_CPF_EMPRESA', FILTER_SANITIZE_STRING);

        echo $entrada_produto->c_buscar_todositens_entrada_D($ent_id, $ID_CPF_EMPRESA);
        break;


    case 'DELETE_ITEM_NOTA':

        $ent_id = filter_input(INPUT_POST, 'ent_id', FILTER_SANITIZE_NUMBER_INT);
        $ID_CPF_EMPRESA = filter_input(INPUT_POST, 'ID_CPF_EMPRESA', FILTER_SANITIZE_STRING);
        $entd_prd_codigo = filter_input(INPUT_POST, 'entd_prd_codigo', FILTER_SANITIZE_NUMBER_INT);      
       
        $retorno = $entrada_produto->c_exclui_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo);
        if ($retorno > 0) {
            echo 1;
        } else {
            echo 0;
        }
      
        
        break;


    case 'AUTO_COMPLETE':

        $where = (!empty($parametro)) ? 'WHERE prd_descricao LIKE ? and  prd_ativo = ' . "'S'" : '';
        $sql = "SELECT prd_codigo,prd_descricao, prd_preco, prd_quant,prd_EAN FROM produtos " . $where;
        $stm = ConPDO::getInstance()->prepare($sql);
        $stm->bindValue(1, '%' . $parametro . '%');
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_OBJ);
        $json = json_encode($dados);
        echo $json;
        break;

    case 'CONSULTA':

        $sql = "SELECT prd_codigo,prd_descricao, prd_preco, prd_quant,prd_EAN from produtos where prd_descricao = ? limit 1 ";
        $stm = ConPDO::getInstance()->prepare($sql);
        $stm->bindValue(1, trim($parametro));
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_OBJ);
        $json = json_encode($dados);
        echo $json;
        break;
}