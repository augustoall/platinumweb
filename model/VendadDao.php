<?php

class VendadDao {

    public static $instance;

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new VendadDao ();
        return self::$instance;
    }

    public function m_inserir_vendad(VendadBean $vendad) {

        try {
            $sql = "INSERT INTO vendad (ID_CPF_EMPRESA,vendac_chave,vendad_nro_item,
                    vendad_ean,vendad_codigo_produto, vendad_descricao_produto,
                    vendad_quantidade,vendad_precovenda,
                    vendad_total) VALUES (:ID_CPF_EMPRESA,:vendac_chave,:vendad_nro_item,
                    :vendad_ean,:vendad_codigo_produto, 
                    :vendad_descricao_produto,:vendad_quantidade,
                    :vendad_precovenda,:vendad_total);";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendad->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $vendad->getVendac_chave());
            $statement_sql->bindValue(":vendad_nro_item", $vendad->getVendad_nro_item());
            $statement_sql->bindValue(":vendad_ean", $vendad->getVendad_ean());
            $statement_sql->bindValue(":vendad_codigo_produto", $vendad->getVendad_codigo_produto());
            $statement_sql->bindValue(":vendad_descricao_produto", $vendad->getVendad_descricao_produto());
            $statement_sql->bindValue(":vendad_quantidade", $vendad->getVendad_quantidade());
            $statement_sql->bindValue(":vendad_precovenda", $vendad->getVendad_precovenda());
            $statement_sql->bindValue(":vendad_total", $vendad->getVendad_total());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em inserir_vendad :: " . $e->getMessage();
        }
    }

    public function m_buscar_itens_da_venda_por_vendac_chave_e_codigoProduto(VendadBean $vendad) {
        try {
            $sql = "select * from vendad where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and vendac_chave = :vendac_chave  and vendad_codigo_produto   = :vendad_codigo_produto              ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendad->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $vendad->getVendac_chave());
            $statement_sql->bindValue(":vendad_codigo_produto", $vendad->getVendad_codigo_produto());

            $statement_sql->execute();
            if ($statement_sql) {
                $itens = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $ven = new VendadBean();
                    $ven->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $ven->setVendac_chave($linha->vendac_chave);
                    $ven->setVendad_nro_item($linha->vendad_nro_item);
                    $ven->setVendad_ean($linha->vendad_ean);
                    $ven->setVendad_codigo_produto($linha->vendad_codigo_produto);
                    $ven->setVendad_descricao_produto($linha->vendad_descricao_produto);
                    $ven->setVendad_quantidade($linha->vendad_quantidade);
                    $ven->setVendad_precovenda($linha->vendad_precovenda);
                    $ven->setVendad_total($linha->vendad_total);
                    $itens[] = $ven;
                }
            }

            return $itens;
        } catch (PDOException $e) {
            print "Erro em m_buscar_itens_da_venda_por_vendac_chave :: " . $e->getMessage();
        }
    }

    public function m_buscar_itens_da_venda_por_vendac_chave(VendadBean $vendad) {
        try {
            $sql = "select * from vendad where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and vendac_chave = :vendac_chave order by vendad_nro_item ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendad->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $vendad->getVendac_chave());

            $statement_sql->execute();
            if ($statement_sql) {
                $itens = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $ven = new VendadBean();
                    $ven->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $ven->setVendac_chave($linha->vendac_chave);
                    $ven->setVendad_nro_item($linha->vendad_nro_item);
                    $ven->setVendad_ean($linha->vendad_ean);
                    $ven->setVendad_codigo_produto($linha->vendad_codigo_produto);
                    $ven->setVendad_descricao_produto($linha->vendad_descricao_produto);
                    $ven->setVendad_quantidade($linha->vendad_quantidade);
                    $ven->setVendad_precovenda($linha->vendad_precovenda);
                    $ven->setVendad_total($linha->vendad_total);
                    $itens[] = $ven;
                }
            }

            return $itens;
        } catch (PDOException $e) {
            print "Erro em m_buscar_itens_da_venda_por_vendac_chave :: " . $e->getMessage();
        }
    }

    public function m_buscar_itens_da_venda_por_vendac_chave_para_diretor(VendadBean $vendad) {
        try {
            $sql = "select * from vendad where vendac_chave = :vendac_chave ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $vendad->getVendac_chave());

            $statement_sql->execute();
            if ($statement_sql) {
                $itens = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $ven = new VendadBean();
                    $ven->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $ven->setVendac_chave($linha->vendac_chave);
                    $ven->setVendad_nro_item($linha->vendad_nro_item);
                    $ven->setVendad_ean($linha->vendad_ean);
                    $ven->setVendad_codigo_produto($linha->vendad_codigo_produto);
                    $ven->setVendad_descricao_produto($linha->vendad_descricao_produto);
                    $ven->setVendad_quantidade($linha->vendad_quantidade);
                    $ven->setVendad_precovenda($linha->vendad_precovenda);
                    $ven->setVendad_total($linha->vendad_total);
                    $itens[] = $ven;
                }
            }

            return $itens;
        } catch (PDOException $e) {
            print "Erro em m_buscar_itens_da_venda_por_vendac_chave :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_VENDAD_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from vendad where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_VENDAD_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}

?>
