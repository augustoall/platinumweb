<?php

class FirebaseDAO {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new FirebaseDAO ();
        return self::$instance;
    }

    public function m_save_device_firebase(FirebaseBean $device) {
        try {
            $sql = "INSERT INTO firebase_devices  (ID_CPF_EMPRESA,registration_id,emp_celularkey) VALUES (?,?,?)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $device->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $device->getRegistration_id());
            $statement_sql->bindValue(3, $device->getEmp_celularkey());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_save_device_firebase :: " . $e->getMessage();
        }
    }

    public function m_delete_device_firebase($emp_celularkey) {
        try {
            $sql = "DELETE FROM firebase_devices WHERE emp_celularkey = ? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $emp_celularkey);
            $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_delete_device :: " . $e->getMessage();
        }
    }

    public function m_atualiza_ID_CPF_EMPRESA_firebase(FirebaseBean $firebase) {
        try {
            $sql = "update firebase_devices set ID_CPF_EMPRESA=? where emp_celularkey=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $firebase->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $firebase->getEmp_celularkey());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualiza_ID_CPF_EMPRESA_firebase :: " . $e->getMessage();
        }
    }

    public function m_getAllDevices() {
        try {
            $sql = "select * from firebase_devices";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fech($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_getAllDevices :: " . $e->getMessage();
        }
    }

    private function fech($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $firebase = new FirebaseBean();
                $firebase->setID($linha->id);
                $firebase->setEmp_celularkey($linha->emp_celularkey);
                $firebase->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $firebase->setRegistration_id($linha->registration_id);
                $results [] = $firebase;
            }
        }
        return $results;
    }

}
