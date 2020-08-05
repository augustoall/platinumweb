<?php

class FornecedoresBean {

    private $ID_CPF_EMPRESA;
    private $for_codigo;
    private $for_razaosocial;
    private $for_fantasia;
    private $for_endereco;
    private $for_cep;
    private $for_bairro;
    private $for_contato1;
    private $for_contato2;
    private $for_representante;
    private $for_email;
    private $for_cnpjcpf;
    private $cid_codigo;
    private $cid_nome;
    

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getFor_codigo() {
        return $this->for_codigo;
    }

    function getFor_razaosocial() {
        return $this->for_razaosocial;
    }

    function getFor_fantasia() {
        return $this->for_fantasia;
    }

    function getFor_endereco() {
        return $this->for_endereco;
    }

    function getFor_cep() {
        return $this->for_cep;
    }

    function getFor_bairro() {
        return $this->for_bairro;
    }

    function getFor_contato1() {
        return $this->for_contato1;
    }

    function getFor_contato2() {
        return $this->for_contato2;
    }

    function getFor_representante() {
        return $this->for_representante;
    }

    function getFor_email() {
        return $this->for_email;
    }

    function getFor_cnpjcpf() {
        return $this->for_cnpjcpf;
    }

    function getCid_codigo() {
        return $this->cid_codigo;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setFor_codigo($for_codigo) {
        $this->for_codigo = $for_codigo;
    }

    function setFor_razaosocial($for_razaosocial) {
        $this->for_razaosocial = $for_razaosocial;
    }

    function setFor_fantasia($for_fantasia) {
        $this->for_fantasia = $for_fantasia;
    }

    function setFor_endereco($for_endereco) {
        $this->for_endereco = $for_endereco;
    }

    function setFor_cep($for_cep) {
        $this->for_cep = $for_cep;
    }

    function setFor_bairro($for_bairro) {
        $this->for_bairro = $for_bairro;
    }

    function setFor_contato1($for_contato1) {
        $this->for_contato1 = $for_contato1;
    }

    function setFor_contato2($for_contato2) {
        $this->for_contato2 = $for_contato2;
    }

    function setFor_representante($for_representante) {
        $this->for_representante = $for_representante;
    }

    function setFor_email($for_email) {
        $this->for_email = $for_email;
    }

    function setFor_cnpjcpf($for_cnpjcpf) {
        $this->for_cnpjcpf = $for_cnpjcpf;
    }

    function setCid_codigo($cid_codigo) {
        $this->cid_codigo = $cid_codigo;
    }
    
    function getCid_nome() {
        return $this->cid_nome;
    }

    function setCid_nome($cid_nome) {
        $this->cid_nome = $cid_nome;
    }



}

?>