<?php

class LogomarcasDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new LogomarcasDao();
        return self::$instance;
    }

    public function m_gravar_logomarca(LogomarcasBean $logo) {

        try {
            $sql = "insert into logomarcas (ID_CPF_EMPRESA,lgm_nomelogo)  values (:ID_CPF_EMPRESA,:lgm_nomelogo)  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $logo->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":lgm_nomelogo", $logo->getLgm_nomelogo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravar_logomarca :: " . $e->getMessage();
        }
    }

    public function m_buscar_logomarca(LogomarcasBean $logo) {

        try {
            $sql = "select * from logomarcas where  ID_CPF_EMPRESA = :ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $logo->getID_CPF_EMPRESA());
            $statement_sql->execute();
            $lgm = new LogomarcasBean();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $lgm->setLgm_nomelogo($stmt["lgm_nomelogo"]);
            return $lgm;
        } catch (PDOException $e) {
            print "Erro em m_buscar_logomarca :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_LOGOMARCAS_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from logomarcas where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_LOGOMARCAS_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}

?>
