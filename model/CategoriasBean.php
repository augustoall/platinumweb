<?php

class CategoriasBean {

    private $ID_CPF_EMPRESA;
    private $cat_codigo;
    private $cat_descricao;
    private $campo;
    private $valor_campo;
    private $tipo_busca;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function getCat_descricao() {
        return $this->cat_descricao;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function setCat_descricao($cat_descricao) {
        $this->cat_descricao = $cat_descricao;
    }

    function getCampo() {
        return $this->campo;
    }

    function getValor_campo() {
        return $this->valor_campo;
    }

    function getTipo_busca() {
        return $this->tipo_busca;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setValor_campo($valor_campo) {
        $this->valor_campo = $valor_campo;
    }

    function setTipo_busca($tipo_busca) {
        $this->tipo_busca = $tipo_busca;
    }

}
?>

