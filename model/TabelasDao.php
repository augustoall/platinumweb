<?php

class TabelasDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new TabelasDao();
        return self::$instance;
    }

    public function m_busca_tabelas() {
        try {

            $sql = "select * from TABELAS";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            return $this->fetch_Array_tabelas($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_busca_tabelas :: " . $e->getMessage() . " Codigo :: " . $e->getCode() . " linha :: " . $e->getLine();
        }
    }

    private function fetch_Array_tabelas($statement) {
        $results = array();
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $tableBean = new TabelasBean();
                $tableBean->setTabela_id($row->tabela_id);
                $tableBean->setTabela_nome($row->tabela_nome);
                $results[] = $tableBean;
            }
        }

        return $results;
    }

    public function m_gravar_nome_das_tabelas(TabelasBean $tabela) {

        try {

            $sql = "INSERT INTO TABELAS (tabela_nome) values (:tabela_nome) ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":tabela_nome", $tabela->getTabela_nome());

            return $statement_sql->execute();
        } catch (PDOException $e) {

            print "Erro em m_gravar_nome_das_tabelas :: " . $e->getMessage() . " Codigo :: " . $e->getCode() . " linha :: " . $e->getLine();
        }
    }

    public function m_verifica_se_tabela_existe(TabelasBean $tabela) {

        try {

            $sql = "select * from TABELAS where tabela_nome = :tabela_nome ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":tabela_nome", $tabela->getTabela_nome());
            $statement_sql->execute();
            return $this->pega_nome_tabela($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {

            print "Erro em m_verifica_se_tabela_existe :: " . $e->getMessage() . " Codigo :: " . $e->getCode() . " linha :: " . $e->getLine();
        }
    }

    public function pega_nome_tabela($linha) {
        $tab = new TabelasBean();
        $tab->setTabela_nome($linha["tabela_nome"]);
        return $tab;
    }

    public function m_busca_todas_tabelas_do_banco() {
        try {
            $db = ConPDO::getInstance();
            $tabelas = array();
            $rs = $db->query("SHOW TABLES");
            $all = $rs->fetchAll();
            foreach ($all as $item) {
                $tabelas[] = $item[0];
            }
            return $tabelas;
        } catch (PDOException $e) {
            print "Erro em m_busca_todas_tabelas_do_banco :: " . $e->getMessage();
        }
    }

}

?>
