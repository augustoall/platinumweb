<?php

class logBean {

    private $log_id;
    private $ID_CPF_EMPRESA;
    private $log_celular_usuario;
    private $log_codigo_usuario;
    private $log_email_usuario;
    private $log_datahora_ocorrencia;
    private $log_tabela;
    private $log_acao;
    
    function getLog_id() {
        return $this->log_id;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getLog_celular_usuario() {
        return $this->log_celular_usuario;
    }

    function getLog_codigo_usuario() {
        return $this->log_codigo_usuario;
    }

    function getLog_email_usuario() {
        return $this->log_email_usuario;
    }

    function getLog_datahora_ocorrencia() {
        return $this->log_datahora_ocorrencia;
    }

    function getLog_tabela() {
        return $this->log_tabela;
    }

    function getLog_acao() {
        return $this->log_acao;
    }

    function setLog_id($log_id) {
        $this->log_id = $log_id;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setLog_celular_usuario($log_celular_usuario) {
        $this->log_celular_usuario = $log_celular_usuario;
    }

    function setLog_codigo_usuario($log_codigo_usuario) {
        $this->log_codigo_usuario = $log_codigo_usuario;
    }

    function setLog_email_usuario($log_email_usuario) {
        $this->log_email_usuario = $log_email_usuario;
    }

    function setLog_datahora_ocorrencia($log_datahora_ocorrencia) {
        $this->log_datahora_ocorrencia = $log_datahora_ocorrencia;
    }

    function setLog_tabela($log_tabela) {
        $this->log_tabela = $log_tabela;
    }

    function setLog_acao($log_acao) {
        $this->log_acao = $log_acao;
    }



}

?>
