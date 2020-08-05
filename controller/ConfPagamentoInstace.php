<?php

class ConfPagamentoInstace {

    function __construct() {
        
    }

    public function c_inserir_conf_pagamento_exportado($ID_CPF_EMPRESA) {

        $confpag = new confPagamentoBean();
        $confpag->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $confpag->setVendac_chave($_POST["vendac_chave"]);
        $confpag->setPag_parcelas_cartao($_POST["pag_parcelas_cartao"]);
        $confpag->setPag_parcelas_normal($_POST["pag_parcelas_normal"]);
        $confpag->setPag_valor_recebido($_POST["pag_valor_recebido"]);
        $confpag->setPag_recebeucom_din_chq_cart($_POST["pag_recebeucom_din_chq_cart"]);
        $confpag->setPag_tipo_pagamento($_POST["pag_tipo_pagamento"]);
        $confpag->setPag_sementrada_comentrada($_POST["pag_sementrada_comentrada"]);
        return conPagamentoDao::getInstance()->m_inserir_conf_pagamento_exportado($confpag);
    }

    public function c_buscar_confpagamento_por_chave($ID_CPF_EMPRESA,$vendac_chave) {
        $confpag = new confPagamentoBean();
        $confpag->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $confpag->setVendac_chave($vendac_chave);
        return conPagamentoDao::getInstance()->m_buscar_confpagamento_por_chave($confpag);
    }

}
?>

