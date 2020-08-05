<?php

class ReceberBean {

    private $ID_CPF_EMPRESA;
    private $rec_codigo;
    private $rec_num_parcela;
    private $rec_cli_codigo;
    private $rec_cli_nome;
    private $vendac_chave;
    private $rec_datamovimento;
    private $rec_valorreceber;
    private $rec_datavencimento;
    private $rec_datavencimento_extenso;
    private $rec_data_que_pagou;
    private $rec_valor_pago;
    private $rec_recebeu_com;
    private $rec_parcelas_cartao;
    private $rec_enviado;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getRec_codigo() {
        return $this->rec_codigo;
    }

    function getRec_num_parcela() {
        return $this->rec_num_parcela;
    }

    function getRec_cli_codigo() {
        return $this->rec_cli_codigo;
    }

    function getRec_cli_nome() {
        return $this->rec_cli_nome;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getRec_datamovimento() {
        return $this->rec_datamovimento;
    }

    function getRec_valorreceber() {
        return $this->rec_valorreceber;
    }

    function getRec_datavencimento() {
        return $this->rec_datavencimento;
    }

    function getRec_datavencimento_extenso() {
        return $this->rec_datavencimento_extenso;
    }

    function getRec_data_que_pagou() {
        return $this->rec_data_que_pagou;
    }

    function getRec_valor_pago() {
        return $this->rec_valor_pago;
    }

    function getRec_recebeu_com() {
        return $this->rec_recebeu_com;
    }

    function getRec_parcelas_cartao() {
        return $this->rec_parcelas_cartao;
    }

    function getRec_enviado() {
        return $this->rec_enviado;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setRec_codigo($rec_codigo) {
        $this->rec_codigo = $rec_codigo;
    }

    function setRec_num_parcela($rec_num_parcela) {
        $this->rec_num_parcela = $rec_num_parcela;
    }

    function setRec_cli_codigo($rec_cli_codigo) {
        $this->rec_cli_codigo = $rec_cli_codigo;
    }

    function setRec_cli_nome($rec_cli_nome) {
        $this->rec_cli_nome = $rec_cli_nome;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setRec_datamovimento($rec_datamovimento) {
        $this->rec_datamovimento = $rec_datamovimento;
    }

    function setRec_valorreceber($rec_valorreceber) {
        $this->rec_valorreceber = $rec_valorreceber;
    }

    function setRec_datavencimento($rec_datavencimento) {
        $this->rec_datavencimento = $rec_datavencimento;
    }

    function setRec_datavencimento_extenso($rec_datavencimento_extenso) {
        $this->rec_datavencimento_extenso = $rec_datavencimento_extenso;
    }

    function setRec_data_que_pagou($rec_data_que_pagou) {
        $this->rec_data_que_pagou = $rec_data_que_pagou;
    }

    function setRec_valor_pago($rec_valor_pago) {
        $this->rec_valor_pago = $rec_valor_pago;
    }

    function setRec_recebeu_com($rec_recebeu_com) {
        $this->rec_recebeu_com = $rec_recebeu_com;
    }

    function setRec_parcelas_cartao($rec_parcelas_cartao) {
        $this->rec_parcelas_cartao = $rec_parcelas_cartao;
    }

    function setRec_enviado($rec_enviado) {
        $this->rec_enviado = $rec_enviado;
    }

}
?>

