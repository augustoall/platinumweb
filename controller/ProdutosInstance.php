<?php

class ProdutosInstance {

    function __construct() {
        
    }

    public function C_gravarProdutoVia_MS_EXEL(ProdutoBean $prod) {
        $produto = new ProdutoBean();
        $produto->setID_CPF_EMPRESA(trim($prod->getID_CPF_EMPRESA()));
        $produto->setPrd_ativo("S");
        $produto->setPrd_EAN(trim($prod->getPrd_EAN()));
        $produto->setPrd_descricao(trim(utf8_encode($prod->getPrd_descricao())));
        $produto->setPrd_descr_red(trim(utf8_encode($prod->getPrd_descr_red())));
        $produto->setPrd_custo(trim(str_replace(",", ".", $prod->getPrd_custo())));
        $produto->setPrd_preco(trim(str_replace(",", ".", $prod->getPrd_preco())));
        $produto->setPrd_quant(trim(str_replace(",", ".", $prod->getPrd_quant())));
        $produto->setPrd_unmed(trim($prod->getPrd_unmed()));
        $produto->setPrd_obs(trim(utf8_encode($prod->getPrd_obs())));
        $produto->setFor_codigo(trim($prod->getFor_codigo()));
        $produto->setCat_codigo(trim($prod->getCat_codigo()));
        return ProdutoDao::getInstance()->M_gravarProduto($produto);
    }

    public function C_AlteraProdutoVia_MS_EXEL(ProdutoBean $prod) {
        $produto = new ProdutoBean();
        $produto->setID_CPF_EMPRESA(trim($prod->getID_CPF_EMPRESA()));
        $produto->setPrd_ativo("S");
        $produto->setPrd_EAN(trim($prod->getPrd_EAN()));
        $produto->setPrd_descricao(trim(utf8_encode($prod->getPrd_descricao())));
        $produto->setPrd_descr_red(trim(utf8_encode($prod->getPrd_descr_red())));
        $produto->setPrd_custo(trim(str_replace(",", ".", $prod->getPrd_custo())));
        $produto->setPrd_preco(trim(str_replace(",", ".", $prod->getPrd_preco())));
        $produto->setPrd_quant(trim(str_replace(",", ".", $prod->getPrd_quant())));
        $produto->setPrd_unmed(trim($prod->getPrd_unmed()));
        $produto->setPrd_obs(trim(utf8_encode($prod->getPrd_obs())));
        $produto->setFor_codigo(trim($prod->getFor_codigo()));
        $produto->setCat_codigo(trim($prod->getCat_codigo()));
        return ProdutoDao::getInstance()->M_alterarProdutoPeloCodigoBARRAS($produto);
    }

    public function C_gravarProduto($ID_CPF_EMPRESA) {
        $produto = new ProdutoBean();
        $produto->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $produto->setPrd_ativo($_POST["prd_ativo"]);
        $produto->setPrd_EAN($_POST["prd_EAN"]);
        $produto->setPrd_descricao(Util::remover_letra_acentuada($_POST["prd_descricao"]));
        $produto->setPrd_descr_red(Util::remover_letra_acentuada($_POST["prd_descr_red"]));
        $produto->setPrd_custo(str_replace(",", ".", $_POST["prd_custo"]));
        $produto->setPrd_preco(str_replace(",", ".", $_POST["prd_preco"]));
        $produto->setPrd_quant(str_replace(",", ".", $_POST["prd_quant"]));
        $produto->setPrd_unmed($_POST["prd_unmed"]);
        $produto->setPrd_obs(Util::remover_letra_acentuada($_POST["prd_obs"]));
        $produto->setFor_codigo($_POST["for_codigo"]);
        $produto->setCat_codigo($_POST["cat_codigo"]);
        return ProdutoDao::getInstance()->M_gravarProduto($produto);
    }

    public function C_alterarProduto($ID_CPF_EMPRESA) {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($_POST["prd_codigo"]);
        $produto->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $produto->setPrd_ativo($_POST["prd_ativo"]);
        $produto->setPrd_EAN($_POST["prd_EAN"]);
        $produto->setPrd_descricao(Util::remover_letra_acentuada($_POST["prd_descricao"]));
        $produto->setPrd_descr_red(Util::remover_letra_acentuada($_POST["prd_descr_red"]));
        $produto->setPrd_custo(str_replace(",", ".", $_POST["prd_custo"]));
        $produto->setPrd_preco(str_replace(",", ".", $_POST["prd_preco"]));
        $produto->setPrd_quant(str_replace(",", ".", $_POST["prd_quant"]));
        $produto->setPrd_unmed($_POST["prd_unmed"]);
        $produto->setPrd_obs(Util::remover_letra_acentuada($_POST["prd_obs"]));
        $produto->setFor_codigo($_POST["for_codigo"]);
        $produto->setCat_codigo($_POST["cat_codigo"]);
        return ProdutoDao::getInstance()->M_alterarProduto($produto);
    }

    public function c_altera_quantidade_estoque($ID_CPF_EMPRESA, $prd_quant, $prd_codigo) {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($prd_codigo);
        $produto->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $produto->setPrd_quant($prd_quant);
        return ProdutoDao::getInstance()->m_altera_quantidade_estoque($produto);
    }

    public function C_buscarTodosProdutos($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->M_buscarTodosProdutos($prodBean);
    }

    public function c_buscarTodosProdutosPorCategoria($ID_CPF_EMPRESA, $cat_codigo) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $prodBean->setCat_codigo($cat_codigo);
        return ProdutoDao::getInstance()->m_buscarTodosProdutosPorCategoria($prodBean);
    }

    public function c_buscarTodosProdutosSemEstoque($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->m_buscarTodosProdutosSemEstoque($prodBean);
    }

    public function C_buscarTodosProdutos_ATIVOS($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->M_buscarTodosProdutos_ATIVOS($prodBean);
    }

    public function c_buscarTodosProdutos_INATIVOS($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->m_buscarTodosProdutos_INATIVOS($prodBean);
    }

    public function C_buscaProdutoPorCodigo($ID_CPF_EMPRESA, $codigo) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $prodBean->setPrd_codigo($codigo);
        return ProdutoDao::getInstance()->M_buscaProdutoPorCodigo($prodBean);
    }

    public function C_buscaProdutoPorCodigoBARRAS($ID_CPF_EMPRESA, $EAN13) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $prodBean->setPrd_EAN($EAN13);
        return ProdutoDao::getInstance()->M_buscaProdutoPorCodigoBARRAS($prodBean);
    }

    public function C_buscaProdutosFiltroCombo($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->M_buscaProdutosFiltroCombo($prodBean);
    }

    public function C_excluirProduto($ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $prodBean->setPrd_codigo($_GET["prd_codigo"]);
        return ProdutoDao::getInstance()->M_excluirProduto($prodBean);
    }

    public function C_buscarTodosProdutos_ComPaginacao($inicio, $quantidade_itens_por_pagina, $ID_CPF_EMPRESA) {
        $prodBean = new ProdutoBean();
        $prodBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ProdutoDao::getInstance()->M_buscaProdutosFiltroCombo_ComPaginacao($inicio, $quantidade_itens_por_pagina, $prodBean);
    }

}

?>