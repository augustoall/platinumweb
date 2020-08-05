<?php

class ProdutoBean {

    private $ID_CPF_EMPRESA;
    private $prd_codigo;
    private $prd_ativo;
    private $prd_EAN;
    private $prd_descricao;
    private $prd_descr_red;
    private $prd_custo;
    private $prd_preco;
    private $prd_unmed;
    private $prd_quant;
    private $prd_obs;
    private $for_codigo;
    private $cat_codigo;
    private $for_fantasia;
    private $cat_descricao;
    
    function __construct() {
        
    }

        function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getPrd_codigo() {
        return $this->prd_codigo;
    }

    function getPrd_ativo() {
        return $this->prd_ativo;
    }

    function getPrd_EAN() {
        return $this->prd_EAN;
    }

    function getPrd_descricao() {
        return $this->prd_descricao;
    }

    function getPrd_descr_red() {
        return $this->prd_descr_red;
    }

    function getPrd_custo() {
        return $this->prd_custo;
    }

    function getPrd_preco() {
        return $this->prd_preco;
    }

    function getPrd_unmed() {
        return $this->prd_unmed;
    }

    function getPrd_quant() {
        return $this->prd_quant;
    }

    function getPrd_obs() {
        return $this->prd_obs;
    }

    function getFor_codigo() {
        return $this->for_codigo;
    }

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setPrd_codigo($prd_codigo) {
        $this->prd_codigo = $prd_codigo;
    }

    function setPrd_ativo($prd_ativo) {
        $this->prd_ativo = $prd_ativo;
    }

    function setPrd_EAN($prd_EAN) {
        $this->prd_EAN = $prd_EAN;
    }

    function setPrd_descricao($prd_descricao) {
        $this->prd_descricao = $prd_descricao;
    }

    function setPrd_descr_red($prd_descr_red) {
        $this->prd_descr_red = $prd_descr_red;
    }

    function setPrd_custo($prd_custo) {
        $this->prd_custo = $prd_custo;
    }

    function setPrd_preco($prd_preco) {
        $this->prd_preco = $prd_preco;
    }

    function setPrd_unmed($prd_unmed) {
        $this->prd_unmed = $prd_unmed;
    }

    function setPrd_quant($prd_quant) {
        $this->prd_quant = $prd_quant;
    }

    function setPrd_obs($prd_obs) {
        $this->prd_obs = $prd_obs;
    }

    function setFor_codigo($for_codigo) {
        $this->for_codigo = $for_codigo;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function getFor_fantasia() {
        return $this->for_fantasia;
    }

    function getCat_descricao() {
        return $this->cat_descricao;
    }

    function setFor_fantasia($for_fantasia) {
        $this->for_fantasia = $for_fantasia;
    }

    function setCat_descricao($cat_descricao) {
        $this->cat_descricao = $cat_descricao;
    }


    
}
