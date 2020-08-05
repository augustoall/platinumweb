<?php

class HistoricoPgtoBean {

    private $hist_codigo;
    private $hist_numero_parcela;
    private $hist_valor_real_parcela;
    private $hist_valor_pago_no_dia;
    private $hist_restante_a_pagar;
    private $hist_datapagamento;
    private $hist_nomecliente;
    private $hist_pagou_com;
    private $vendac_chave;
    private $hist_enviado;
    private $ID_CPF_EMPRESA;
    private $usu_celularkey;

    function __construct() {
        
    }

    function getHist_codigo() {
        return $this->hist_codigo;
    }

    function getHist_numero_parcela() {
        return $this->hist_numero_parcela;
    }

    function getHist_valor_real_parcela() {
        return $this->hist_valor_real_parcela;
    }

    function getHist_valor_pago_no_dia() {
        return $this->hist_valor_pago_no_dia;
    }

    function getHist_restante_a_pagar() {
        return $this->hist_restante_a_pagar;
    }

    function getHist_datapagamento() {
        return $this->hist_datapagamento;
    }

    function getHist_nomecliente() {
        return $this->hist_nomecliente;
    }

    function getHist_pagou_com() {
        return $this->hist_pagou_com;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getHist_enviado() {
        return $this->hist_enviado;
    }

    function setHist_codigo($hist_codigo) {
        $this->hist_codigo = $hist_codigo;
    }

    function setHist_numero_parcela($hist_numero_parcela) {
        $this->hist_numero_parcela = $hist_numero_parcela;
    }

    function setHist_valor_real_parcela($hist_valor_real_parcela) {
        $this->hist_valor_real_parcela = $hist_valor_real_parcela;
    }

    function setHist_valor_pago_no_dia($hist_valor_pago_no_dia) {
        $this->hist_valor_pago_no_dia = $hist_valor_pago_no_dia;
    }

    function setHist_restante_a_pagar($hist_restante_a_pagar) {
        $this->hist_restante_a_pagar = $hist_restante_a_pagar;
    }

    function setHist_datapagamento($hist_datapagamento) {
        $this->hist_datapagamento = $hist_datapagamento;
    }

    function setHist_nomecliente($hist_nomecliente) {
        $this->hist_nomecliente = $hist_nomecliente;
    }

    function setHist_pagou_com($hist_pagou_com) {
        $this->hist_pagou_com = $hist_pagou_com;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setHist_enviado($hist_enviado) {
        $this->hist_enviado = $hist_enviado;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function getUsu_celularkey() {
        return $this->usu_celularkey;
    }

    function setUsu_celularkey($usu_celularkey) {
        $this->usu_celularkey = $usu_celularkey;
    }

}

?>
