<?php

class EntradaProdutoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EntradaProdutoDao();
        return self::$instance;
    }

    public function m_grava_entrada_produto(EntradaProdutoBean $produto) {
        try {
            $sql = "insert into entrada_produtos (ID_CPF_EMPRESA,ent_numeronota,ent_data_entrada,ent_valor_nota,usu_codigo,for_codigo) values (?,?,?,?,?,?)";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $produto->getEnt_numeronota());
            $statement_sql->bindValue(3, $produto->getEnt_data_entrada());
            $statement_sql->bindValue(4, $produto->getEnt_valor_nota());
            $statement_sql->bindValue(5, $produto->getUsu_codigo());
            $statement_sql->bindValue(6, $produto->getFor_codigo());
            $statement_sql->execute();
            $ultimoId = ConPDO::getInstance()->lastInsertId();
            return $ultimoId;
        } catch (PDOException $e) {
            print "Erro em m_grava_entrada_produto :: " . $e->getMessage();
        }
    }

    public function m_altera_entrada_produto(EntradaProdutoBean $produto) {

        try {
            $sql = "update entrada_produtos set ID_CPF_EMPRESA=?,ent_numeronota=?,ent_data_entrada=?,ent_valor_nota=?,usu_codigo=?,for_codigo=? where ID_CPF_EMPRESA=? and ent_id=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $produto->getEnt_numeronota());
            $statement_sql->bindValue(3, $produto->getEnt_data_entrada());
            $statement_sql->bindValue(4, $produto->getEnt_valor_nota());
            $statement_sql->bindValue(5, $produto->getUsu_codigo());
            $statement_sql->bindValue(6, $produto->getFor_codigo());
            $statement_sql->bindValue(7, $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(8, $produto->getEnt_id());
            return $statement_sql->execute();
        } catch (PDOException $e) {

            print "Erro em m_altera_entrada_produto :: " . $e->getMessage();
        }
    }

    public function m_exclui_entrada($ent_id, $ID_CPF_EMPRESA) {
        try {
            $sql = "delete from entrada_produtos where where ID_CPF_EMPRESA=? and ent_id=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_id);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_exclui_entrada :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_as_entradasprodutos($ID_CPF_EMPRESA) {
        try {
            $sql = "select * from entrada_produtos where ID_CPF_EMPRESA=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_as_entradasprodutos :: " . $e->getMessage();
        }
    }

    public function m_buscar_entradaproduto_porcodigo($ent_id, $ID_CPF_EMPRESA) {
        try {
            $sql = "select * from entrada_produtos where ID_CPF_EMPRESA=? and ent_id=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_id);
            $statement_sql->execute();
            return $this->popula_objeto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscar_entradaproduto_porcodigo :: " . $e->getMessage();
        }
    }

    public function m_busca_numeronota($ID_CPF_EMPRESA, $ent_numeronota) {
        try {
            $sql = "select * from entrada_produtos where ID_CPF_EMPRESA=? and ent_numeronota=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_numeronota);
            $statement_sql->execute();
            return $this->popula_objeto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_busca_numeronota :: " . $e->getMessage();
        }
    }

    private function fetch_array($statement_sql) {

        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $entrada = array();
                $entrada['ent_id'] = $linha->ent_id;
                $entrada['ID_CPF_EMPRESA'] = $linha->ID_CPF_EMPRESA;
                $entrada['ent_numeronota'] = $linha->ent_numeronota;
                $entrada['ent_data_entrada'] = $linha->ent_data_entrada;
                $entrada['ent_valor_nota'] = $linha->ent_valor_nota;
                $entrada['usu_codigo'] = $linha->usu_codigo;
                $entrada['for_codigo'] = $linha->for_codigo;
                $results[] = $entrada;
            }
        }

        return $results;
    }

    private function popula_objeto($prod) {
        $entrada = array();
        $entrada['ent_id'] = $prod["ent_id"];
        $entrada['ID_CPF_EMPRESA'] = $prod["ID_CPF_EMPRESA"];
        $entrada['ent_numeronota'] = $prod["ent_numeronota"];
        $entrada['ent_data_entrada'] = $prod["ent_data_entrada"];
        $entrada['ent_valor_nota'] = $prod["ent_valor_nota"];
        $entrada['usu_codigo'] = $prod["usu_codigo"];
        $entrada['for_codigo'] = $prod["for_codigo"];
        return $entrada;
    }

    private function buildInsert($arrayDados) {

        // Inicializa variáveis   
        $sql = "";
        $campos = "";
        $valores = "";

        // Loop para montar a instrução com os campos e valores   
        foreach ($arrayDados as $chave => $valor):
            $campos .= $chave . ', ';
            $valores .= '?, ';
        endforeach;

        // Retira vírgula do final da string   
        $campos = (substr($campos, -2) == ', ') ? trim(substr($campos, (strlen($campos) - 2))) : $campos;

        // Retira vírgula do final da string   
        $valores = (substr($valores, -2) == ', ') ? trim(substr($valores, (strlen($valores) - 2))) : $valores;

        // Concatena todas as variáveis e finaliza a instrução   
        $sql .= "INSERT INTO {$this->tabela} (" . $campos . ")VALUES(" . $valores . ")";

        // Retorna string com instrução SQL   
        return trim($sql);
    }

    public function setTableName($tabela) {
        if (!empty($tabela)) {
            $this->tabela = $tabela;
        }
    }

    public function insert($arrayDados) {
        try {

            // Atribui a instrução SQL construida no método   
            $sql = $this->buildInsert($arrayDados);

            // Passa a instrução para o PDO   
            $stm = ConPDO::getInstance()->prepare($sql);

            // Loop para passar os dados como parâmetro   
            $cont = 1;
            foreach ($arrayDados as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno   
            $retorno = $stm->execute();

            return $retorno;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

}
