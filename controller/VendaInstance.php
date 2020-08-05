<?php

class VendaInstance {

    function __construct() {
        
    }

    public function c_recebe_venda_do_android() {
        $vendac = new VendacBean();

        $vendac->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $vendac->setVendac_chave($_POST["vendac_chave"]);
        $vendac->setVendac_datahoravenda($_POST["vendac_datahoravenda"]);
        $vendac->setVendac_previsao_entrega($_POST["vendac_previsao_entrega"]);
        $vendac->setVendac_usu_codigo($_POST["vendac_usu_codigo"]);
        $vendac->setVendac_usu_nome(Util::remover_letra_acentuada($_POST["vendac_usu_nome"]));
        $vendac->setVendac_cli_codigo($_POST["vendac_cli_codigo"]);
        $vendac->setVendac_cli_nome(Util::remover_letra_acentuada($_POST["vendac_cli_nome"]));
        $vendac->setVendac_fpgto_codigo($_POST["vendac_fpgto_codigo"]);
        $vendac->setVendac_fpgto_tipo($_POST["vendac_fpgto_tipo"]);
        $vendac->setVendac_valor($_POST["vendac_valor"]);
        $vendac->setVendac_peso_total($_POST["vendac_peso_total"]);
        $vendac->setVendac_observacao(Util::remover_letra_acentuada($_POST["vendac_observacao"]));
        $vendac->setVendac_enviada("N");
        $vendac->setVendac_latitude($_POST["vendac_latitude"]);
        $vendac->setVendac_longitude($_POST["vendac_longitude"]);
        return VendacDao::getInstance()->m_recebe_venda_do_android($vendac);
    }

    public function c_buscar_todas_vendasc($ID_CPF_EMPRESA) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return VendacDao::getInstance()->m_buscar_todas_vendasc($vendac);
    }

    public function c_buscar_apenas_vendas_vendedor($ID_CPF_EMPRESA, $vendac_usu_codigo) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_usu_codigo($vendac_usu_codigo);
        return VendacDao::getInstance()->m_buscar_apenas_vendas_vendedor($vendac);
    }

    public function c_busca_vendac_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_chave($vendac_chave);
        return VendacDao::getInstance()->m_busca_vendac_por_vendac_chave($vendac);
    }

    public function c_buscar_vendas_paginacao($inicio, $limitpage, $ID_CPF_EMPRESA) {
        return VendacDao::getInstance()->m_buscar_vendas_paginacao($inicio, $limitpage, $ID_CPF_EMPRESA);
    }

    //*************************************************
    //*************************************************
    ///                3 METODOS USADOS NO ARQUIVO relatorio de vendas por cliente USER , ADM , DIRETOR
    public function c_busca_vendac_por_cli_codigo_e_data_between($ID_CPF_EMPRESA, $vendac_cli_codigo, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_cli_codigo($vendac_cli_codigo);
        return VendacDao::getInstance()->m_busca_vendac_por_cli_codigo_e_data_between($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_busca_vendas_do_vendedor_por_cli_codigo_e_data_between($ID_CPF_EMPRESA, $vendac_cli_codigo, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_cli_codigo($vendac_cli_codigo);
        $vendac->setVendac_usu_codigo($_SESSION["usu_codigo"]);
        return VendacDao::getInstance()->m_busca_vendas_do_vendedor_por_cli_codigo_e_data_between($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_busca_vendas_DIRETOR_data_betweenCLIENTE($vendac_cli_codigo, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setVendac_cli_codigo($vendac_cli_codigo);
        return VendacDao::getInstance()->m_busca_vendas_DIRETOR_data_betweenCLIENTE($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_atualiza_nome_vendedor_vendac($vendac_usu_nome, $vendac_usu_codigo, $ID_CPF_EMPRESA) {
        return VendacDao::getInstance()->m_atualiza_nome_vendedor_vendac($vendac_usu_nome, $vendac_usu_codigo, $ID_CPF_EMPRESA);
    }

    public function c_atualiza_codigo_cliente_offline_vendac($new_codigo, $old_codigo, $ID_CPF_EMPRESA) {
        return VendacDao::getInstance()->m_atualiza_codigo_cliente_offline_vendac($new_codigo, $old_codigo, $ID_CPF_EMPRESA);
    }

    //*************************************************
    //*************************************************
    ///   3 METODOS USADOS NO ARQUIVO relatorio de vendas por periodo  USER , ADM , DIRETOR

    public function c_busca_vendac_por_periodo($ID_CPF_EMPRESA, $data_inicial, $datafinal) {
        return VendacDao::getInstance()->m_busca_vendac_por_periodo($ID_CPF_EMPRESA, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_conta_vendas_do_dia($ID_CPF_EMPRESA, $data_inicial, $datafinal) {
        return VendacDao::getInstance()->m_conta_vendas_do_dia($ID_CPF_EMPRESA, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_busca_vendas_do_vendedor_por_periodo($ID_CPF_EMPRESA, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_usu_codigo($_SESSION["usu_codigo"]);
        return VendacDao::getInstance()->m_busca_vendas_do_vendedor_por_periodo($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_busca_vendas_DIRETOR_por_periodo($data_inicial, $datafinal) {
        return VendacDao::getInstance()->m_busca_vendas_DIRETOR_por_periodo(Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    //*************************************************
    //*************************************************
    ///   3 METODOS USADOS NO ARQUIVO relatorio de vendas por vendedor  USER , ADM , DIRETOR

    public function c_busca_vendac_por_usu_codigo_e_data_between($ID_CPF_EMPRESA, $vendac_usu_codigo, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $vendac->setVendac_usu_codigo($vendac_usu_codigo);
        return VendacDao::getInstance()->m_busca_vendac_por_usu_codigo_e_data_between($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    public function c_busca_vendas_DIRETOR_data_betweenVENDEDOR($vendac_usu_codigo, $data_inicial, $datafinal) {
        $vendac = new VendacBean();
        $vendac->setVendac_usu_codigo($vendac_usu_codigo);
        return VendacDao::getInstance()->m_busca_vendas_DIRETOR_data_betweenVENDEDOR($vendac, Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($datafinal));
    }

    //*************************************************
    //*************************************************
    public function c_busca_vendac_por_vendac_chave_para_diretor($vendac_chave) {
        $vendac = new VendacBean();
        $vendac->setVendac_chave($vendac_chave);
        return VendacDao::getInstance()->m_busca_vendac_por_vendac_chave_para_diretor($vendac);
    }

    public function c_listar_todas_vendasc_para_diretor() {
        return VendacDao::getInstance()->m_listar_todas_vendasc_para_diretor();
    }

    public function c_busca_produtos_mais_vendidos_POR_PERIODO($data_ini, $data_fim, $ID_CPF_EMPRESA) {
        return VendacDao::getInstance()->m_busca_produtos_mais_vendidos_POR_PERIODO($data_ini, $data_fim, $ID_CPF_EMPRESA);
    }

    public function c_busca_clientes_que_compram_mais($ID_CPF_EMPRESA) {
        return VendacDao::getInstance()->m_busca_clientes_que_compram_mais($ID_CPF_EMPRESA);
    }

    //*********************************************************
    ////*********************************************************
    ////*********************************************************
    ////*********************************************************
    ////*********************************************************
    ////*********************************************************
    ////*********************************************************
    ////*********************************************************
    //
    // ABAIXO METODOS DA CLASSE DETALHES >> VENDAD

    public function c_inserir_vendad() {
        $ven = new VendadBean();
        $ven->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $ven->setVendac_chave($_POST["vendac_chave"]);
        $ven->setVendad_nro_item($_POST["vendad_nro_item"]);
        $ven->setVendad_ean($_POST["vendad_ean"]);
        $ven->setVendad_codigo_produto($_POST["vendad_codigo_produto"]);
        $ven->setVendad_descricao_produto($_POST["vendad_descricao_produto"]);
        $ven->setVendad_quantidade($_POST["vendad_quantidade"]);
        $ven->setVendad_precovenda($_POST["vendad_precovenda"]);
        $ven->setVendad_total($_POST["vendad_total"]);
        return VendadDao::getInstance()->m_inserir_vendad($ven);
    }

    public function DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave) {
        $ven = new VendadBean();
        $ven->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $ven->setVendac_chave($vendac_chave);
        return VendadDao::getInstance()->m_buscar_itens_da_venda_por_vendac_chave($ven);
    }

    public function c_buscar_itens_da_venda_por_vendac_chave_e_codigoProduto($ID_CPF_EMPRESA, $vendac_chave, $codigo_produto) {
        $ven = new VendadBean();
        $ven->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $ven->setVendac_chave($vendac_chave);
        $ven->setVendad_codigo_produto($codigo_produto);
        return VendadDao::getInstance()->m_buscar_itens_da_venda_por_vendac_chave_e_codigoProduto($ven);
    }

    public function c_buscar_itens_da_venda_por_vendac_chave_para_diretor($vendac_chave) {
        $ven = new VendadBean();
        $ven->setVendac_chave($vendac_chave);
        return VendadDao::getInstance()->m_buscar_itens_da_venda_por_vendac_chave_para_diretor($ven);
    }

    // GERACAO DE GRAFICOS

    public function c_grafico_de_vendas_por_vendedor($ID_CPF_EMPRESA) {
        $ven = new VendacBean();
        $ven->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return VendacDao::getInstance()->m_grafico_de_vendas_por_vendedor($ven);
    }

}
?>

