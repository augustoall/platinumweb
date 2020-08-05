<?php

class logDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new logDao();
        return self::$instance;
    }

    public function m_inserir_log(logBean $log) {

        try {

            $sql = "insert into log (
                                    ID_CPF_EMPRESA, 
                                    log_celular_usuario, 
                                    log_codigo_usuario,
                                    log_email_usuario,
                                    log_datahora_ocorrencia, 
                                    log_tabela, log_acao) 
                                    values (
                                    :ID_CPF_EMPRESA, 
                                    :log_celular_usuario, 
                                    :log_codigo_usuario,
                                    :log_email_usuario,
                                    :log_datahora_ocorrencia,
                                    :log_tabela,
                                    :log_acao)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $log->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":log_celular_usuario", $log->getLog_celular_usuario());
            $statement_sql->bindValue(":log_codigo_usuario", $log->getLog_codigo_usuario());
            $statement_sql->bindValue(":log_email_usuario", $log->getLog_email_usuario());
            $statement_sql->bindValue(":log_datahora_ocorrencia", $log->getLog_datahora_ocorrencia());
            $statement_sql->bindValue(":log_tabela", $log->getLog_tabela());
            $statement_sql->bindValue(":log_acao", $log->getLog_acao());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_inserir_log :: " . $e->getMessage();
        }
    }

    public function m_delete_log($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from log where ID_CPF_EMPRESA = ? and log_datahora_ocorrencia < DATE_SUB(NOW(), INTERVAL 10 DAY) ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_delete_log :: " . $e->getMessage();
        }
    }

    public function m_buscar_logs(logBean $log) {
        try {
            $sql = "select * from log where ID_CPF_EMPRESA = ?"
                    . " AND log_tabela != 'DIRETOR_ERRORS' "
                    . " AND log_tabela != 'LICENCA' "
                    . " AND log_tabela != 'EMPRESA' "
                    . "order by log_datahora_ocorrencia desc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $log->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fetch_array_log($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_logs :: " . $e->getMessage();
        }
    }

    public function m_buscar_todos_logs_diretor() {
        try {
            $sql = "select * from log order by log_datahora_ocorrencia desc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);           
            $statement_sql->execute();
            return $this->fetch_array_log($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_logs :: " . $e->getMessage();
        }
    }

    private function fetch_array_log($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $log = new logBean();
                $log->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $log->setLog_acao($linha->log_acao);
                $log->setLog_celular_usuario($linha->log_celular_usuario);
                $log->setLog_codigo_usuario($linha->log_codigo_usuario);
                $log->setLog_datahora_ocorrencia($linha->log_datahora_ocorrencia);
                $log->setLog_email_usuario($linha->log_email_usuario);
                $log->setLog_tabela($linha->log_tabela);
                $results [] = $log;
            }
        }
        return $results;
    }

}
?>

