<?php

class HistoricoPgtoInstance {

    function __construct() {
        
    }

    public function c_inserir_historicoPgto_exportado() {

        $historico = new HistoricoPgtoBean();
        $historico->setHist_numero_parcela($_POST["hist_numero_parcela"]);
        $historico->setHist_valor_real_parcela($_POST["hist_valor_real_parcela"]);
        $historico->setHist_valor_pago_no_dia($_POST["hist_valor_pago_no_dia"]);
        $historico->setHist_restante_a_pagar($_POST["hist_restante_a_pagar"]);
        $historico->setHist_datapagamento($_POST["hist_datapagamento"]);
        $historico->setHist_nomecliente(Util::remover_letra_acentuada($_POST["hist_nomecliente"]));
        $historico->setHist_pagou_com($_POST["hist_pagou_com"]);
        $historico->setVendac_chave($_POST["vendac_chave"]);
        $historico->setHist_enviado("N");
        $historico->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $historico->setUsu_celularkey($_POST["usu_celularkey"]);
        return HistoricoPgtoDao::getInstance()->m_inserir_historicoPgto_exportado($historico);
    }

    public function c_excluirHistoricosPgto() {
        $historico = new HistoricoPgtoBean();
        $historico->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $historico->setUsu_celularkey($_POST["usu_celularKey"]);
        return HistoricoPgtoDao::getInstance()->m_excluirHistoricosPgto($historico);
    }

    public function c_buscar_apenas_historicos_vendedor($ID_CPF_EMPRESA, $usu_celularKey) {
        $historico = new HistoricoPgtoBean();
        $historico->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $historico->setUsu_celularkey($usu_celularKey);
        return HistoricoPgtoDao::getInstance()->m_buscar_apenas_historicos_vendedor($historico);
    }

    public function c_buscar_historicos_adm($ID_CPF_EMPRESA) {
        $historico = new HistoricoPgtoBean();
        $historico->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return HistoricoPgtoDao::getInstance()->m_buscar_historicos_adm($historico);
    }

    public function c_buscar_historicos_diretor() {
        return HistoricoPgtoDao::getInstance()->m_buscar_historicos_diretor();
    }

}

?>