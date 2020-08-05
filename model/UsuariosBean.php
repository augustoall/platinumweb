<?php

class UsuariosBean {

    private $usu_codigo;
    private $usu_nome;
    private $usu_email;
    private $usu_celularkey;
    private $usu_numerocelular;
    private $usu_cpf;
    private $usu_dispositivo;
    private $usu_liberado;
    private $usu_desconto;
    private $usu_comissao;
    private $ID_CPF_EMPRESA;

    function __construct() {
        
    }

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getUsu_nome() {
        return $this->usu_nome;
    }

    function getUsu_email() {
        return $this->usu_email;
    }

    function getUsu_celularkey() {
        return $this->usu_celularkey;
    }

    function getUsu_numerocelular() {
        return $this->usu_numerocelular;
    }

    function getUsu_cpf() {
        return $this->usu_cpf;
    }

    function getUsu_dispositivo() {
        return $this->usu_dispositivo;
    }

    function getUsu_liberado() {
        return $this->usu_liberado;
    }

    function getUsu_desconto() {
        return $this->usu_desconto;
    }

    function getUsu_comissao() {
        return $this->usu_comissao;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setUsu_nome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    function setUsu_email($usu_email) {
        $this->usu_email = $usu_email;
    }

    function setUsu_celularkey($usu_celularkey) {
        $this->usu_celularkey = $usu_celularkey;
    }

    function setUsu_numerocelular($usu_numerocelular) {
        $this->usu_numerocelular = $usu_numerocelular;
    }

    function setUsu_cpf($usu_cpf) {
        $this->usu_cpf = $usu_cpf;
    }

    function setUsu_dispositivo($usu_dispositivo) {
        $this->usu_dispositivo = $usu_dispositivo;
    }

    function setUsu_liberado($usu_liberado) {
        $this->usu_liberado = $usu_liberado;
    }

    function setUsu_desconto($usu_desconto) {
        $this->usu_desconto = $usu_desconto;
    }

    function setUsu_comissao($usu_comissao) {
        $this->usu_comissao = $usu_comissao;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

}
