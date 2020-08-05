<?php

class TransactionsCMDV {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new TransactionsCMDV();
        return self::$instance;
    }

    public function m_delete_sistema($ID_CPF_EMPRESA) {
        try {
            ConPDO::getInstance()->beginTransaction();

            $sql = "delete from receber  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from imagensprd  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from entrada_produtos_d  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from vendad  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from produtos  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from fornecedores  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from cheques where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from vendac  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from entrada_produtos  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from usuarios  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from categorias where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from clientes where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from conf_pagamento where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from empresa  where emp_cpf = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from empresa_config  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from firebase_devices  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from historico_pagamento  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from log  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from logomarcas  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from permissoes  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from produtos  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $sql = "delete from receber  where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();

            ConPDO::getInstance()->commit();
        } catch (PDOException $e) {
            ConPDO::getInstance()->rollback();
            print "Erro em m_delete_sistema :: " . $e->getMessage();
        }
    }

}
