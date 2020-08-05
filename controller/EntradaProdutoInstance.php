<?php

class EntradaProdutoInstance {

    public function c_grava_entrada_produto($ID_CPF_EMPRESA, $ent_numeronota, $ent_data_entrada, $ent_valor_nota, $usu_codigo, $for_codigo) {
        $entrada = new EntradaProdutoBean();
        $entrada->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $entrada->setEnt_numeronota($ent_numeronota);
        $entrada->setEnt_data_entrada($ent_data_entrada);
        $entrada->setEnt_valor_nota(str_replace(",", ".", $ent_valor_nota));
        $entrada->setUsu_codigo($usu_codigo);
        $entrada->setFor_codigo($for_codigo);
        return EntradaProdutoDao::getInstance()->m_grava_entrada_produto($entrada);
    }

    public function c_altera_entrada_produto($ent_id, $ID_CPF_EMPRESA, $ent_numeronota, $ent_data_entrada, $ent_valor_nota, $usu_codigo, $for_codigo) {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_id($ent_id);
        $entrada->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $entrada->setEnt_numeronota($ent_numeronota);
        $entrada->setEnt_data_entrada($ent_data_entrada);
        $entrada->setEnt_valor_nota(str_replace(",", ".", $ent_valor_nota));
        $entrada->setUsu_codigo($usu_codigo);
        $entrada->setFor_codigo($for_codigo);
        return EntradaProdutoDao::getInstance()->m_altera_entrada_produto($entrada);
    }

    public function c_exclui_entrada($ent_id, $ID_CPF_EMPRESA) {
        return EntradaProdutoDao::getInstance()->m_exclui_entrada($ent_id, $ID_CPF_EMPRESA);
    }

    public function c_buscar_todas_as_entradasprodutos($ID_CPF_EMPRESA) {
        return EntradaProdutoDao::getInstance()->m_buscar_todas_as_entradasprodutos($ID_CPF_EMPRESA);
    }

    public function c_buscar_entradaproduto_porcodigo($ent_id, $ID_CPF_EMPRESA) {
        return EntradaProdutoDao::getInstance()->m_buscar_entradaproduto_porcodigo($ent_id, $ID_CPF_EMPRESA);
    }

    public function c_busca_numeronota($ID_CPF_EMPRESA, $ent_numeronota) {
        return EntradaProdutoDao::getInstance()->m_busca_numeronota($ID_CPF_EMPRESA, $ent_numeronota);
    }

    //************************************** 
    //******  OPERAÇOES NA TABELA DE ITENS DA ENTRADA DE PRODUTOS

    public function c_grava_itens_entrada_produtos_D($ID_CPF_EMPRESA, $ent_id, $entd_ean, $entd_prd_codigo, $entd_descricaoprd, $entd_custo, $entd_qtd, $entd_margem, $entd_preco) {
        $entrada_itens = new EntradaProdutoBean_D();
        $entrada_itens->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $entrada_itens->setEnt_id($ent_id);
        $entrada_itens->setEntd_ean($entd_ean);
        $entrada_itens->setEntd_prd_codigo($entd_prd_codigo);
        $entrada_itens->setEntd_descricaoprd($entd_descricaoprd);
        $entrada_itens->setEntd_custo(str_replace(",", ".", $entd_custo));
        $entrada_itens->setEntd_qtd(str_replace(",", ".", $entd_qtd));
        $entrada_itens->setEntd_margem(str_replace(",", ".", $entd_margem));
        $entrada_itens->setEntd_preco(str_replace(",", ".", $entd_preco));
        return EntradaProdutoDao_D::getInstance()->m_grava_itens_entrada_produtos_D($entrada_itens);
    }

    public function c_buscar_todositens_entrada_D($ent_id, $ID_CPF_EMPRESA) {
        return EntradaProdutoDao_D::getInstance()->m_buscar_todositens_entrada_D($ent_id, $ID_CPF_EMPRESA);
    }

    public function c_exclui_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo) {
        return EntradaProdutoDao_D::getInstance()->m_exclui_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo);
    }

    public function c_busca_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo) {
        return EntradaProdutoDao_D::getInstance()->m_busca_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo);
    }

}
