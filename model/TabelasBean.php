<?php

class TabelasBean {

    private $tabela_id;
    private $tabela_nome;
    private $nome_banco;

    function __construct() {
        
    }

    function getNome_banco() {
        return $this->nome_banco;
    }

    function setNome_banco($nome_banco) {
        $this->nome_banco = $nome_banco;
    }

        
    function getTabela_id() {
        return $this->tabela_id;
    }

    function getTabela_nome() {
        return $this->tabela_nome;
    }

    function setTabela_id($tabela_id) {
        $this->tabela_id = $tabela_id;
    }

    function setTabela_nome($tabela_nome) {
        $this->tabela_nome = $tabela_nome;
    }

}
