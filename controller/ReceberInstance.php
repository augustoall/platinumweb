<?php

class ReceberInstance {

    public function c_inserir_receber_exportado($ID_CPF_EMPRESA) {

        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setRec_num_parcela($_POST["rec_num_parcela"]);
        $receber->setRec_cli_codigo($_POST["rec_cli_codigo"]);
        $receber->setRec_cli_nome(Util::remover_letra_acentuada($_POST["rec_cli_nome"]));
        $receber->setVendac_chave($_POST["vendac_chave"]);
        $receber->setRec_datamovimento($_POST["rec_datamovimento"]);
        $receber->setRec_valorreceber($_POST["rec_valorreceber"]);
        $receber->setRec_datavencimento($_POST["rec_datavencimento"]);
        $receber->setRec_datavencimento_extenso($_POST["rec_datavencimento_extenso"]);
        $receber->setRec_data_que_pagou($_POST["rec_data_que_pagou"]);
        $receber->setRec_valor_pago($_POST["rec_valor_pago"]);
        $receber->setRec_recebeu_com(Util::remover_letra_acentuada($_POST["rec_recebeu_com"]));
        $receber->setRec_parcelas_cartao($_POST["rec_parcelas_cartao"]);
        $receber->setRec_enviado("N");
        return ReceberDao::getInstance()->m_inserir_receber_exportado($receber);
    }

    public function c_update_receber_exportado($ID_CPF_EMPRESA) {

        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setRec_num_parcela($_POST["rec_num_parcela"]);
        $receber->setRec_cli_codigo($_POST["rec_cli_codigo"]);
        $receber->setRec_cli_nome(Util::remover_letra_acentuada($_POST["rec_cli_nome"]));
        $receber->setVendac_chave($_POST["vendac_chave"]);
        $receber->setRec_datamovimento($_POST["rec_datamovimento"]);
        $receber->setRec_valorreceber($_POST["rec_valorreceber"]);
        $receber->setRec_datavencimento($_POST["rec_datavencimento"]);
        $receber->setRec_datavencimento_extenso($_POST["rec_datavencimento_extenso"]);
        $receber->setRec_data_que_pagou($_POST["rec_data_que_pagou"]);
        $receber->setRec_valor_pago($_POST["rec_valor_pago"]);
        $receber->setRec_recebeu_com(Util::remover_letra_acentuada($_POST["rec_recebeu_com"]));
        $receber->setRec_parcelas_cartao($_POST["rec_parcelas_cartao"]);
        $receber->setRec_enviado("N");
        return ReceberDao::getInstance()->m_update_receber_exportado($receber);
    }

    public function c_buscar_todas_contas_receber_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setVendac_chave($vendac_chave);
        return ReceberDao::getInstance()->m_buscar_todas_contas_receber_por_vendac_chave($receber);
    }

    public function c_buscar_todas_contas_receber($ID_CPF_EMPRESA) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ReceberDao::getInstance()->m_buscar_todas_contas_receber($receber);
    }

    public function c_buscar_conta_receber_por_chave_e_numparcela($ID_CPF_EMPRESA) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setVendac_chave($_POST["vendac_chave"]);
        $receber->setRec_num_parcela($_POST["rec_num_parcela"]);
        return ReceberDao::getInstance()->m_buscar_conta_receber_por_chave_e_numparcela($receber);
    }
    
    
     public function c_atualiza_codigo_cliente_offline_receber($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo) {
       return ReceberDao::getInstance()->m_atualiza_codigo_cliente_offline_receber($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo); 
    }

    // ********************************************************************
    // // ********************************************************************
    // CONSULTAS PARA RELATORIOS 
    // CONSULTAS PARA RELATORIOS  ADM

    public function c_busca_contas_EM_ABERTO_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $rec_cli_codigo, $data_inicial, $data_final) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setRec_cli_codigo($rec_cli_codigo);
        return ReceberDao::getInstance()->m_busca_contas_EM_ABERTO_por_rec_cli_codigo_ADM($receber, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($data_final));
    }

    public function c_busca_contas_PAGAS_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $rec_cli_codigo, $data_inicial, $data_final) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setRec_cli_codigo($rec_cli_codigo);
        return ReceberDao::getInstance()->m_busca_contas_PAGAS_por_rec_cli_codigo_ADM($receber, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($data_final));
    }

    public function c_busca_contas_TODAS_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $rec_cli_codigo, $data_inicial, $data_final) {
        $receber = new ReceberBean();
        $receber->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $receber->setRec_cli_codigo($rec_cli_codigo);
        return ReceberDao::getInstance()->m_busca_contas_TODAS_por_rec_cli_codigo_ADM($receber, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($data_final));
    }

    // ********************************************************************
    // ********************************************************************
    // CONSULTAS PARA RELATORIOS 
    // CONSULTAS PARA RELATORIOS  USER
}
?>




