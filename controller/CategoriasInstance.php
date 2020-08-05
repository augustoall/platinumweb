<?php

class CategoriasInstance {

    function __construct() {
        
    }

    public function c_gravarCategorias($ID_CPF_EMPRESA) {
        $categoria = new CategoriasBean();        
        $categoria->setCat_descricao(Util::remover_letra_acentuada($_POST["cat_descricao"]));
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return CategoriasDao::getInstance()->m_gravarCategorias($categoria);
    }

    public function c_alterarCategorias($ID_CPF_EMPRESA) {
        $categoria = new CategoriasBean();
        $categoria->setCat_codigo($_POST["cat_codigo"]);
        $categoria->setCat_descricao(Util::remover_letra_acentuada($_POST["cat_descricao"]));
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return CategoriasDao::getInstance()->m_alterarCategorias($categoria);
    }

    public function c_excluirCategorias($ID_CPF_EMPRESA) {
        $categoria = new CategoriasBean();
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $categoria->setCat_codigo($_GET["cat_codigo"]);
        return CategoriasDao::getInstance()->m_excluirCategorias($categoria);
    }

    public function c_buscaTodasCategorias($ID_CPF_EMPRESA) {
        $categoria = new CategoriasBean();
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return CategoriasDao::getInstance()->m_buscaTodasCategorias($categoria);
    }

    public function c_buscaCategoriasPorCodigo($ID_CPF_EMPRESA) {
        $categoria = new CategoriasBean();
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $categoria->setCat_codigo($_GET["cat_codigo"]);
        return CategoriasDao::getInstance()->m_buscaCategoriasPorCodigo($categoria);
    }

    public function c_buscarCategoriasFiltrosCombo($ID_CPF_EMPRESA) {

        $categoria = new CategoriasBean();
        $categoria->setCampo((isset($_POST["buscar_por"]) ? $_POST["buscar_por"] : "cli_codigo"));
        $categoria->setValor_campo((isset($_POST["valor_campo"]) ? $_POST["valor_campo"] : ""));
        $categoria->setTipo_busca($tipo_busca = (isset($_POST["tipo_busca"]) ? $_POST["tipo_busca"] : ""));
        $categoria->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return CategoriasDao::getInstance()->m_buscarCategoriasFiltrosCombo($categoria);
    }

}
?>

