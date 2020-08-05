<?php

class ChequesBean {

    private $ID_CPF_EMPRESA;
    private $chq_codigo;
    private $chq_cli_codigo;
    private $chq_numerocheque;
    private $chq_telefone1;
    private $chq_telefone2;
    private $chq_cpf_dono;
    private $chq_nomedono;
    private $chq_nomebanco;
    private $chq_vencimento;
    private $chq_valorcheque;
    private $chq_terceiro;
    private $vendac_chave;
    private $chq_dataCadastro;
    private $chq_enviado;
    
    private $cli_nome;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getChq_codigo() {
        return $this->chq_codigo;
    }

    function getChq_cli_codigo() {
        return $this->chq_cli_codigo;
    }

    function getChq_numerocheque() {
        return $this->chq_numerocheque;
    }

    function getChq_telefone1() {
        return $this->chq_telefone1;
    }

    function getChq_telefone2() {
        return $this->chq_telefone2;
    }

    function getChq_cpf_dono() {
        return $this->chq_cpf_dono;
    }

    function getChq_nomedono() {
        return $this->chq_nomedono;
    }

    function getChq_nomebanco() {
        return $this->chq_nomebanco;
    }

    function getChq_vencimento() {
        return $this->chq_vencimento;
    }

    function getChq_valorcheque() {
        return $this->chq_valorcheque;
    }

    function getChq_terceiro() {
        return $this->chq_terceiro;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getChq_enviado() {
        return $this->chq_enviado;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setChq_codigo($chq_codigo) {
        $this->chq_codigo = $chq_codigo;
    }

    function setChq_cli_codigo($chq_cli_codigo) {
        $this->chq_cli_codigo = $chq_cli_codigo;
    }

    function setChq_numerocheque($chq_numerocheque) {
        $this->chq_numerocheque = $chq_numerocheque;
    }

    function setChq_telefone1($chq_telefone1) {
        $this->chq_telefone1 = $chq_telefone1;
    }

    function setChq_telefone2($chq_telefone2) {
        $this->chq_telefone2 = $chq_telefone2;
    }

    function setChq_cpf_dono($chq_cpf_dono) {
        $this->chq_cpf_dono = $chq_cpf_dono;
    }

    function setChq_nomedono($chq_nomedono) {
        $this->chq_nomedono = $chq_nomedono;
    }

    function setChq_nomebanco($chq_nomebanco) {
        $this->chq_nomebanco = $chq_nomebanco;
    }

    function setChq_vencimento($chq_vencimento) {
        $this->chq_vencimento = $chq_vencimento;
    }

    function setChq_valorcheque($chq_valorcheque) {
        $this->chq_valorcheque = $chq_valorcheque;
    }

    function setChq_terceiro($chq_terceiro) {
        $this->chq_terceiro = $chq_terceiro;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setChq_enviado($chq_enviado) {
        $this->chq_enviado = $chq_enviado;
    }

    function getChq_dataCadastro() {
        return $this->chq_dataCadastro;
    }

    function setChq_dataCadastro($chq_dataCadastro) {
        $this->chq_dataCadastro = $chq_dataCadastro;
    }

    
    function getCli_nome() {
        return $this->cli_nome;
    }

    function setCli_nome($cli_nome) {
        $this->cli_nome = $cli_nome;
    }



    
}
?>

