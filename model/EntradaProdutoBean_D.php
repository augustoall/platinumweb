<?php

class EntradaProdutoBean_D {

    private $ID_CPF_EMPRESA;
    private $ent_id;
    private $entd_ean;
    private $entd_prd_codigo;
    private $entd_descricaoprd;
    private $entd_custo;
    private $entd_qtd;
    private $entd_margem;
    private $entd_preco;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getEnt_id() {
        return $this->ent_id;
    }

    function getEntd_ean() {
        return $this->entd_ean;
    }

    function getEntd_prd_codigo() {
        return $this->entd_prd_codigo;
    }

    function getEntd_descricaoprd() {
        return $this->entd_descricaoprd;
    }

    function getEntd_custo() {
        return $this->entd_custo;
    }

    function getEntd_qtd() {
        return $this->entd_qtd;
    }

    function getEntd_margem() {
        return $this->entd_margem;
    }

    function getEntd_preco() {
        return $this->entd_preco;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setEnt_id($ent_id) {
        $this->ent_id = $ent_id;
    }

    function setEntd_ean($entd_ean) {
        $this->entd_ean = $entd_ean;
    }

    function setEntd_prd_codigo($entd_prd_codigo) {
        $this->entd_prd_codigo = $entd_prd_codigo;
    }

    function setEntd_descricaoprd($entd_descricaoprd) {
        $this->entd_descricaoprd = $entd_descricaoprd;
    }

    function setEntd_custo($entd_custo) {
        $this->entd_custo = $entd_custo;
    }

    function setEntd_qtd($entd_qtd) {
        $this->entd_qtd = $entd_qtd;
    }

    function setEntd_margem($entd_margem) {
        $this->entd_margem = $entd_margem;
    }

    function setEntd_preco($entd_preco) {
        $this->entd_preco = $entd_preco;
    }

}
