<?php

class CategoriasDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new CategoriasDao ();
        return self::$instance;
    }

    public function m_gravarCategorias(CategoriasBean $categoria) {

        try {
            $sql = "insert into categorias (cat_descricao,ID_CPF_EMPRESA) values (:cat_descricao,:ID_CPF_EMPRESA)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_descricao", $categoria->getCat_descricao());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarCategorias :: " . $e->getMessage();
        }
    }

    public function m_alterarCategorias(CategoriasBean $categoria) {
        try {
            $sql = "update categorias set cat_descricao = :cat_descricao where cat_codigo=:cat_codigo and ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":cat_descricao", $categoria->getCat_descricao());
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_alterarCategorias :: " . $e->getMessage();
        }
    }

    public function m_excluirCategorias(CategoriasBean $categoria) {
        try {
            $sql = "delete from categorias where cat_codigo=:cat_codigo and ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            Util::getErrorPDOException($e, 'CATEGORIA DE PRODUTOS', 'CADASTRO DE PRODUTOS', $categoria->getCat_codigo(), $categoria->getID_CPF_EMPRESA(), 'https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2');
        }
    }

    public function m_buscaTodasCategorias(CategoriasBean $categoria) {
        try {
            $sql = "select * from categorias where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            $statement_sql->execute();

            return $this->fetch_array_categorias($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscaTodasCategorias :: " . $e->getMessage();
        }
    }

    public function m_buscaCategoriasPorCodigo(CategoriasBean $categoria) {
        try {
            $sql = "select * from categorias where  cat_codigo = :cat_codigo and  ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            $statement_sql->execute();

            return $this->popula_objeto_categoria($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscaTodasCategorias :: " . $e->getMessage();
        }
    }

    public function popula_objeto_categoria($linha) {
        $categoria = new CategoriasBean();
        $categoria->setCat_codigo($linha["cat_codigo"]);
        $categoria->setCat_descricao($linha["cat_descricao"]);
        $categoria->setID_CPF_EMPRESA($linha["ID_CPF_EMPRESA"]);
        return $categoria;
    }

    public function m_buscarCategoriasFiltrosCombo(CategoriasBean $categoria) {

        if ($categoria->getTipo_busca() == 1)
            $sql_busca = " = '" . $categoria->getValor_campo() . "'";

        if ($categoria->getTipo_busca() == 2)
            $sql_busca = " like '%" . $categoria->getValor_campo() . "%'";

        if ($categoria->getTipo_busca() == 3)
            $sql_busca = " like '" . $categoria->getValor_campo() . "%'";

        try {
            $sql = "select * from categorias where  " . $categoria->getCampo() . "  " . $sql_busca . "   and ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $categoria->getID_CPF_EMPRESA());
            $statement_sql->execute();

            return $this->fetch_array_categorias($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscaTodasCategorias :: " . $e->getMessage();
        }
    }

    private function fetch_array_categorias($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $categoria = new CategoriasBean();
                $categoria->setCat_codigo($linha->cat_codigo);
                $categoria->setCat_descricao($linha->cat_descricao);
                $categoria->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $results [] = $categoria;
            }
        }
        return $results;
    }

    public function m_EXCLUIR_CATEGORIA_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from categorias where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluir_empresa_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}

?>