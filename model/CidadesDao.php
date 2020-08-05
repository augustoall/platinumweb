<?php

class CidadesDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new CidadesDao();
        return self::$instance;
    }

    public function m_busca_todas_cidades(CidadesBean $cidade) {
        try {
            $sql = "SELECT * from cidades WHERE cid_codigo IN (SELECT DISTINCT cid_codigo from clientes)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_cidades($statement_sql);
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_todas_cidades :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_todas_cidades_relatorio_cliente() {
        try {
            $sql = "SELECT * from cidades WHERE cid_codigo IN (SELECT DISTINCT cid_codigo from clientes)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_cidades($statement_sql);
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_todas_cidades_relatorio_cliente :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_todas_cidades_combobox($estado) {
        try {
            $sql = 'SELECT * FROM cidades WHERE cid_uf = ? ORDER BY cid_nome ASC';
            $stm = ConPDO::getInstance()->prepare($sql);
            $stm->bindValue(1, $estado);
            $stm->execute();
            return json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_todas_cidades_combobox :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_cidade_por_codigo_ibge($cid_codigo) {
        try {
            $sql = 'SELECT * FROM cidades where cid_codigo = ? limit 1';
            $stm = ConPDO::getInstance()->prepare($sql);
            $stm->bindValue(1, $cid_codigo);
            $stm->execute();
            return json_encode($stm->fetch(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_cidade_por_codigo_ibge :: " . $e->getMessage() . "   ]]]";
        }
    }

    private function fetch_array_cidades($statement) {
        $results = array();
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $cidade = new CidadesBean();
                $cidade->setCid_codigo($row->cid_codigo);
                $cidade->setCid_nome($row->cid_nome);
                $cidade->setCid_uf($row->cid_uf);
                $results[] = $cidade;
            }
        }
        return $results;
    }

    public function m_busca_cidade_por_codigo($cid_codigo) {
        try {
            $sql = "SELECT * FROM cidades where cid_codigo = ? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cid_codigo);
            $statement_sql->execute();
            return $this->populacidades($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_cidade_por_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    private function populacidades($linha) {
        $cidade = new CidadesBean();
        $cidade->setCid_codigo($linha["cid_codigo"]);
        $cidade->setCid_nome($linha["cid_nome"]);
        $cidade->setCid_uf($linha["cid_uf"]);
        $cidade->setCodigo_estado($linha["codigo_estado"]);
        return $cidade;
    }

}

?>