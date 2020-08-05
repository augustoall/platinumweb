<?php

class TabelasInstance {

    function __construct() {
        
    }

    public function c_busca_nome_das_tabelas_gravadas() {
        return TabelasDao::getInstance()->m_busca_tabelas();
    }

    public function c_busca_todas_tabelas_do_banco() {

        return TabelasDao::getInstance()->m_busca_todas_tabelas_do_banco();
    }

    public function c_verifica_se_tabela_existe($tb) {

        $tabela = new TabelasBean();
        $tabela->setTabela_nome($tb);
        return TabelasDao::getInstance()->m_verifica_se_tabela_existe($tabela);
    }

    public function c_gravar_nome_das_tabelas($tab) {
        $tabela = new TabelasBean();
        $tabela->setTabela_nome($tab);
        return TabelasDao::getInstance()->m_gravar_nome_das_tabelas($tabela);
    }

}
?>

