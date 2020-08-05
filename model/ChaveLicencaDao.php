<?php

class ChaveLicencaDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ChaveLicencaDao ();
        return self::$instance;
    }

    public function m_grava_chave(ChaveLicencaBean $chave) {

        try {
            $sql = "INSERT INTO chave_de_licenca (lic_chave, lic_dias, lic_usada_por, lic_datahora_uso, lic_status) VALUES ( :lic_chave, :lic_dias, :lic_usada_por, :lic_datahora_uso, :lic_status)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":lic_chave", $chave->getLic_chave());
            $statement_sql->bindValue(":lic_dias", $chave->getLic_dias());
            $statement_sql->bindValue(":lic_usada_por", $chave->getLic_usada_por());
            $statement_sql->bindValue(":lic_datahora_uso", $chave->getLic_datahora_uso());
            $statement_sql->bindValue(":lic_status", $chave->getLic_status());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_grava_chave :: " . $e->getMessage();
        }
    }

    public function m_atualiza_chave(ChaveLicencaBean $chave) {

        try {
            $sql = "update chave_de_licenca set  lic_usada_por = :lic_usada_por  , lic_datahora_uso = :lic_datahora_uso  , lic_status = :lic_status  where lic_chave = :lic_chave   ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":lic_usada_por", $chave->getLic_usada_por());
            $statement_sql->bindValue(":lic_datahora_uso", $chave->getLic_datahora_uso());
            $statement_sql->bindValue(":lic_status", $chave->getLic_status());
            $statement_sql->bindValue(":lic_chave", $chave->getLic_chave());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualiza_chave :: " . $e->getMessage();
        }
    }

    public function m_busca_chave_licenca_nao_usada(ChaveLicencaBean $chave) {

        try {
            $sql = "select * from chave_de_licenca where lic_chave = :lic_chave  and  lic_status = 'N' and lic_usada_por = ''  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":lic_chave", $chave->getLic_chave());
            $statement_sql->execute();
            $lic = new ChaveLicencaBean();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $lic->setLic_dias($stmt["lic_dias"]);
            $lic->setLic_chave($stmt["lic_chave"]);
            return $lic;
        } catch (PDOException $e) {
            print "Erro em m_busca_chave_licenca_nao_usada :: " . $e->getMessage();
        }
    }

    public function m_buscar_chaves_licencas() {

        try {
            $sql = "select * from chave_de_licenca order by lic_status asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            $resultado = array();
            if ($statement_sql) {
                while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $l = new ChaveLicencaBean();
                    $l->setLic_chave($row->lic_chave);
                    $l->setLic_datahora_uso($row->lic_datahora_uso);
                    $l->setLic_dias($row->lic_dias);
                    $l->setLic_status($row->lic_status);
                    $l->setLic_usada_por($row->lic_usada_por);
                    $resultado[] = $l;
                }
            }

            return $resultado;
        } catch (PDOException $e) {
            print "Erro em m_busca_chave_licenca_nao_usada :: " . $e->getMessage();
        }
    }

    public function m_buscar_chaves_licencas_nao_usadas() {

        try {
            $sql = "select * from chave_de_licenca where lic_status='N' order by lic_status asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            $resultado = array();
            if ($statement_sql) {
                while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $l = new ChaveLicencaBean();
                    $l->setLic_chave($row->lic_chave);
                    $l->setLic_datahora_uso($row->lic_datahora_uso);
                    $l->setLic_dias($row->lic_dias);
                    $l->setLic_status($row->lic_status);
                    $l->setLic_usada_por($row->lic_usada_por);
                    $resultado[] = $l;
                }
            }

            return $resultado;
        } catch (PDOException $e) {
            print "Erro em m_busca_chave_licenca_nao_usada :: " . $e->getMessage();
        }
    }

}
?>

