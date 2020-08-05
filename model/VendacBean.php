<?php

class VendacBean {

    private $vendac_id;
    private $vendac_chave;
    private $vendac_datahoravenda;
    private $vendac_previsao_entrega;
    private $vendac_usu_codigo;
    private $vendac_usu_nome;
    private $vendac_cli_codigo;
    private $vendac_cli_nome;
    private $vendac_fpgto_codigo;
    private $vendac_fpgto_tipo;
    private $vendac_valor;
    private $vendac_peso_total;
    private $vendac_observacao;
    private $vendac_enviada;
    private $vendac_latitude;
    private $vendac_longitude;
    private $ID_CPF_EMPRESA;

    function getVendac_id() {
        return $this->vendac_id;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getVendac_datahoravenda() {
        return $this->vendac_datahoravenda;
    }

    function getVendac_previsao_entrega() {
        return $this->vendac_previsao_entrega;
    }

    function getVendac_usu_codigo() {
        return $this->vendac_usu_codigo;
    }

    function getVendac_usu_nome() {
        return $this->vendac_usu_nome;
    }

    function getVendac_cli_codigo() {
        return $this->vendac_cli_codigo;
    }

    function getVendac_cli_nome() {
        return $this->vendac_cli_nome;
    }

    function getVendac_fpgto_codigo() {
        return $this->vendac_fpgto_codigo;
    }

    function getVendac_fpgto_tipo() {
        return $this->vendac_fpgto_tipo;
    }

    function getVendac_valor() {
        return $this->vendac_valor;
    }

    function getVendac_peso_total() {
        return $this->vendac_peso_total;
    }

    function getVendac_observacao() {
        return $this->vendac_observacao;
    }

    function getVendac_enviada() {
        return $this->vendac_enviada;
    }

    function getVendac_latitude() {
        return $this->vendac_latitude;
    }

    function getVendac_longitude() {
        return $this->vendac_longitude;
    }

    function setVendac_id($vendac_id) {
        $this->vendac_id = $vendac_id;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setVendac_datahoravenda($vendac_datahoravenda) {
        $this->vendac_datahoravenda = $vendac_datahoravenda;
    }

    function setVendac_previsao_entrega($vendac_previsao_entrega) {
        $this->vendac_previsao_entrega = $vendac_previsao_entrega;
    }

    function setVendac_usu_codigo($vendac_usu_codigo) {
        $this->vendac_usu_codigo = $vendac_usu_codigo;
    }

    function setVendac_usu_nome($vendac_usu_nome) {
        $this->vendac_usu_nome = $vendac_usu_nome;
    }

    function setVendac_cli_codigo($vendac_cli_codigo) {
        $this->vendac_cli_codigo = $vendac_cli_codigo;
    }

    function setVendac_cli_nome($vendac_cli_nome) {
        $this->vendac_cli_nome = $vendac_cli_nome;
    }

    function setVendac_fpgto_codigo($vendac_fpgto_codigo) {
        $this->vendac_fpgto_codigo = $vendac_fpgto_codigo;
    }

    function setVendac_fpgto_tipo($vendac_fpgto_tipo) {
        $this->vendac_fpgto_tipo = $vendac_fpgto_tipo;
    }

    function setVendac_valor($vendac_valor) {
        $this->vendac_valor = $vendac_valor;
    }

    function setVendac_peso_total($vendac_peso_total) {
        $this->vendac_peso_total = $vendac_peso_total;
    }

    function setVendac_observacao($vendac_observacao) {
        $this->vendac_observacao = $vendac_observacao;
    }

    function setVendac_enviada($vendac_enviada) {
        $this->vendac_enviada = $vendac_enviada;
    }

    function setVendac_latitude($vendac_latitude) {
        $this->vendac_latitude = $vendac_latitude;
    }

    function setVendac_longitude($vendac_longitude) {
        $this->vendac_longitude = $vendac_longitude;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

}

?>
