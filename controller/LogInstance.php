<?php

class LogInstance {

    function __construct() {
        
    }

    public function c_inserir_log($tabela, $acao, $celular, $codusuario, $datahora, $email, $ID_CPF_EMPRESA) {
        $log = new logBean();
        $log->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $log->setLog_acao($acao);
        $log->setLog_celular_usuario($celular);
        $log->setLog_codigo_usuario($codusuario);
        $log->setLog_datahora_ocorrencia($datahora);
        $log->setLog_email_usuario($email);
        $log->setLog_tabela($tabela);
        return logDao::getInstance()->m_inserir_log($log);
    }

    public function c_buscar_logs($ID_CPF_EMPRESA) {
        $log = new logBean();
        $log->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return logDao::getInstance()->m_buscar_logs($log);
    }

    public function c_buscar_todos_logs_diretor() {
        return logDao::getInstance()->m_buscar_todos_logs_diretor();
    }

    public function m_delete_log($ID_CPF_EMPRESA) {
        return logDao::getInstance()->m_delete_log($ID_CPF_EMPRESA);
    }

}

?>
