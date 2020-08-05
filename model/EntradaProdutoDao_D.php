<?php

class EntradaProdutoDao_D {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EntradaProdutoDao_D();
        return self::$instance;
    }

    public function m_grava_itens_entrada_produtos_D(EntradaProdutoBean_D $itens) {
        try {
            $sql = "insert into entrada_produtos_d (ID_CPF_EMPRESA,ent_id,entd_ean,entd_prd_codigo,entd_descricaoprd,entd_custo,entd_qtd,entd_margem,entd_preco) values (?,?,?,?,?,?,?,?,?) ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $itens->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $itens->getEnt_id());
            $statement_sql->bindValue(3, $itens->getEntd_ean());
            $statement_sql->bindValue(4, $itens->getEntd_prd_codigo());
            $statement_sql->bindValue(5, $itens->getEntd_descricaoprd());
            $statement_sql->bindValue(6, $itens->getEntd_custo());
            $statement_sql->bindValue(7, $itens->getEntd_qtd());
            $statement_sql->bindValue(8, $itens->getEntd_margem());
            $statement_sql->bindValue(9, $itens->getEntd_preco());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarentradaproduto :: " . $e->getMessage();
        }
    }

    public function m_buscar_todositens_entrada_D($ent_id, $ID_CPF_EMPRESA) {
        try {
            $sql = "select * from entrada_produtos_d where ID_CPF_EMPRESA=? and ent_id=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_id);
            $statement_sql->execute();
            $dados = $statement_sql->fetchAll(PDO::FETCH_OBJ);
            return json_encode($dados);
        } catch (PDOException $e) {
            print "Erro em m_buscar_todositens_entrada :: " . $e->getMessage();
        }
    }

    public function m_exclui_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo) {
        try {
            $sql = "delete from entrada_produtos_d where ID_CPF_EMPRESA=? and ent_id=? and entd_prd_codigo=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_id);
            $statement_sql->bindValue(3, $entd_prd_codigo);
            $statement_sql->execute();
            return $statement_sql->rowCount();
        } catch (PDOException $e) {
            print "Erro em m_exclui_item_entrada :: " . $e->getMessage();
        }
    }

    public function m_busca_item_entrada_D($ent_id, $ID_CPF_EMPRESA, $entd_prd_codigo) {
        try {
            $sql = "select * from entrada_produtos_d where ID_CPF_EMPRESA=? and ent_id=? and entd_prd_codigo=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->bindValue(2, $ent_id);
            $statement_sql->bindValue(3, $entd_prd_codigo);
            $statement_sql->execute();
            return $this->popula_objeto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_busca_item_entrada :: " . $e->getMessage();
        }
    }

    private function fetch_array($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $entrada = array();
                $entrada['ID_CPF_EMPRESA'] = $linha->ID_CPF_EMPRESA;
                $entrada['ent_id'] = $linha->ent_id;
                $entrada['entd_ean'] = $linha->entd_ean;
                $entrada['entd_prd_codigo'] = $linha->entd_prd_codigo;
                $entrada['entd_descricaoprd'] = $linha->entd_descricaoprd;
                $entrada['entd_custo'] = $linha->entd_custo;
                $entrada['entd_qtd'] = $linha->entd_qtd;
                $entrada['entd_margem'] = $linha->entd_margem;
                $entrada['entd_preco'] = $linha->entd_preco;
                $results[] = $entrada;
            }
        }
        return $results;
    }

    private function popula_objeto($prod) {
        $entrada = array();
        $entrada['ID_CPF_EMPRESA'] = $prod['ID_CPF_EMPRESA'];
        $entrada['ent_id'] = $prod['ent_id'];
        $entrada['entd_ean'] = $prod['entd_ean'];
        $entrada['entd_prd_codigo'] = $prod['entd_prd_codigo'];
        $entrada['entd_descricaoprd'] = $prod['entd_descricaoprd'];
        $entrada['entd_custo'] = $prod['entd_custo'];
        $entrada['entd_qtd'] = $prod['entd_qtd'];
        $entrada['entd_margem'] = $prod['entd_margem'];
        $entrada['entd_preco'] = $prod['entd_preco'];
        return $entrada;
    }

}
