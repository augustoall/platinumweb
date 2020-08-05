<?php

class CidadesInstace {

    function __construct() {
        
    }

    public function c_busca_todas_cidades() {
        return CidadesDao::getInstance()->m_busca_todas_cidades();
    }

    public function c_busca_todas_cidades_relatorio_cliente() {
        return CidadesDao::getInstance()->m_busca_todas_cidades_relatorio_cliente();
    }

    public function c_busca_todas_cidades_combobox($estado) {
        return CidadesDao::getInstance()->m_busca_todas_cidades_combobox($estado);
    }

    public function c_busca_cidade_por_codigo_ibge($cid_codigo) {
        return CidadesDao::getInstance()->m_busca_cidade_por_codigo_ibge($cid_codigo);
    }

    public function c_busca_cidade_por_codigo($cid_codigo) {
        return CidadesDao::getInstance()->m_busca_cidade_por_codigo($cid_codigo);
    }

}

?>
