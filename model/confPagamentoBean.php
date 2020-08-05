<?php

class confPagamentoBean {

    private $pag_id;
    private $ID_CPF_EMPRESA;
    private $vendac_chave;
    private $pag_parcelas_cartao;
    private $pag_parcelas_normal;
    private $pag_valor_recebido;
    private $pag_recebeucom_din_chq_cart;
    private $pag_tipo_pagamento;
    private $pag_sementrada_comentrada;
     
    
    function getPag_id() {
        return $this->pag_id;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getPag_parcelas_cartao() {
        return $this->pag_parcelas_cartao;
    }

    function getPag_parcelas_normal() {
        return $this->pag_parcelas_normal;
    }

    function getPag_valor_recebido() {
        return $this->pag_valor_recebido;
    }

    function getPag_recebeucom_din_chq_cart() {
        return $this->pag_recebeucom_din_chq_cart;
    }

    function getPag_tipo_pagamento() {
        return $this->pag_tipo_pagamento;
    }

    function getPag_sementrada_comentrada() {
        return $this->pag_sementrada_comentrada;
    }

    function setPag_id($pag_id) {
        $this->pag_id = $pag_id;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setPag_parcelas_cartao($pag_parcelas_cartao) {
        $this->pag_parcelas_cartao = $pag_parcelas_cartao;
    }

    function setPag_parcelas_normal($pag_parcelas_normal) {
        $this->pag_parcelas_normal = $pag_parcelas_normal;
    }

    function setPag_valor_recebido($pag_valor_recebido) {
        $this->pag_valor_recebido = $pag_valor_recebido;
    }

    function setPag_recebeucom_din_chq_cart($pag_recebeucom_din_chq_cart) {
        $this->pag_recebeucom_din_chq_cart = $pag_recebeucom_din_chq_cart;
    }

    function setPag_tipo_pagamento($pag_tipo_pagamento) {
        $this->pag_tipo_pagamento = $pag_tipo_pagamento;
    }

    function setPag_sementrada_comentrada($pag_sementrada_comentrada) {
        $this->pag_sementrada_comentrada = $pag_sementrada_comentrada;
    }




}
?>

