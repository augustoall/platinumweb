<?php

class PermissoesBean {

    private $per_codigo;
    private $nome_tabela;
    private $log_numerocelular;
    private $usu_celularkey;
    private $per_incluir;
    private $per_alterar;
    private $per_visualizar;
    private $per_excluir;
    private $ID_CPF_EMPRESA;
    private $per_nivel;

    function getPer_codigo() {
        return $this->per_codigo;
    }

    function getNome_tabela() {
        return $this->nome_tabela;
    }

    function getLog_numerocelular() {
        return $this->log_numerocelular;
    }

    function getUsu_celularkey() {
        return $this->usu_celularkey;
    }

    function getPer_incluir() {
        return $this->per_incluir;
    }

    function getPer_alterar() {
        return $this->per_alterar;
    }

    function getPer_visualizar() {
        return $this->per_visualizar;
    }

    function getPer_excluir() {
        return $this->per_excluir;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getPer_nivel() {
        return $this->per_nivel;
    }

    function setPer_codigo($per_codigo) {
        $this->per_codigo = $per_codigo;
    }

    function setNome_tabela($nome_tabela) {
        $this->nome_tabela = $nome_tabela;
    }

    function setLog_numerocelular($log_numerocelular) {
        $this->log_numerocelular = $log_numerocelular;
    }

    function setUsu_celularkey($usu_celularkey) {
        $this->usu_celularkey = $usu_celularkey;
    }

    function setPer_incluir($per_incluir) {
        $this->per_incluir = $per_incluir;
    }

    function setPer_alterar($per_alterar) {
        $this->per_alterar = $per_alterar;
    }

    function setPer_visualizar($per_visualizar) {
        $this->per_visualizar = $per_visualizar;
    }

    function setPer_excluir($per_excluir) {
        $this->per_excluir = $per_excluir;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setPer_nivel($per_nivel) {
        $this->per_nivel = $per_nivel;
    }

}

?>
