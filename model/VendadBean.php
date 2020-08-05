<?php

class VendadBean {

    private $ID_CPF_EMPRESA;
    private $vendac_chave;
    private $vendad_nro_item;
    private $vendad_ean;
    private $vendad_codigo_produto;
    private $vendad_descricao_produto;
    private $vendad_quantidade;
    private $vendad_precovenda;
    private $vendad_total;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getVendad_nro_item() {
        return $this->vendad_nro_item;
    }

    function getVendad_ean() {
        return $this->vendad_ean;
    }

    function getVendad_codigo_produto() {
        return $this->vendad_codigo_produto;
    }

    function getVendad_descricao_produto() {
        return $this->vendad_descricao_produto;
    }

    function getVendad_quantidade() {
        return $this->vendad_quantidade;
    }

    function getVendad_precovenda() {
        return $this->vendad_precovenda;
    }

    function getVendad_total() {
        return $this->vendad_total;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setVendad_nro_item($vendad_nro_item) {
        $this->vendad_nro_item = $vendad_nro_item;
    }

    function setVendad_ean($vendad_ean) {
        $this->vendad_ean = $vendad_ean;
    }

    function setVendad_codigo_produto($vendad_codigo_produto) {
        $this->vendad_codigo_produto = $vendad_codigo_produto;
    }

    function setVendad_descricao_produto($vendad_descricao_produto) {
        $this->vendad_descricao_produto = $vendad_descricao_produto;
    }

    function setVendad_quantidade($vendad_quantidade) {
        $this->vendad_quantidade = $vendad_quantidade;
    }

    function setVendad_precovenda($vendad_precovenda) {
        $this->vendad_precovenda = $vendad_precovenda;
    }

    function setVendad_total($vendad_total) {
        $this->vendad_total = $vendad_total;
    }

}

?>