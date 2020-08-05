<?php

class conPagamentoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new conPagamentoDao();
        return self::$instance;
    }

    public function m_inserir_conf_pagamento_exportado(confPagamentoBean $confpag) {

        try {

            $sql = "INSERT INTO conf_pagamento (ID_CPF_EMPRESA, vendac_chave, pag_parcelas_cartao, pag_parcelas_normal, pag_valor_recebido, pag_recebeucom_din_chq_cart, pag_tipo_pagamento, pag_sementrada_comentrada) VALUES ( "
                    . ":ID_CPF_EMPRESA,  "
                    . ":vendac_chave,  "
                    . ":pag_parcelas_cartao, "
                    . ":pag_parcelas_normal, "
                    . ":pag_valor_recebido, "
                    . ":pag_recebeucom_din_chq_cart, "
                    . ":pag_tipo_pagamento, "
                    . ":pag_sementrada_comentrada);";


            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $confpag->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $confpag->getVendac_chave());
            $statement_sql->bindValue(":pag_parcelas_cartao", $confpag->getPag_parcelas_cartao());
            $statement_sql->bindValue(":pag_parcelas_normal", $confpag->getPag_parcelas_normal());
            $statement_sql->bindValue(":pag_valor_recebido", $confpag->getPag_valor_recebido());
            $statement_sql->bindValue(":pag_recebeucom_din_chq_cart", $confpag->getPag_recebeucom_din_chq_cart());
            $statement_sql->bindValue(":pag_tipo_pagamento", $confpag->getPag_tipo_pagamento());
            $statement_sql->bindValue(":pag_sementrada_comentrada", $confpag->getPag_sementrada_comentrada());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[ Erro em m_inserir_conf_pagamento_exportado :: " . $e->getMessage() . " ]";
        }
    }

    public function m_buscar_confpagamento_por_chave(confPagamentoBean $confpag) {
        try {
            $sql = "select * from conf_pagamento where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and vendac_chave = :vendac_chave";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $confpag->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $confpag->getVendac_chave());
            $statement_sql->execute();
            $r = new confPagamentoBean();

            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);

            $r->setPag_id($stmt["pag_id"]);
            $r->setPag_parcelas_normal($stmt["pag_parcelas_normal"]);
             $r->setPag_parcelas_cartao($stmt["pag_parcelas_cartao"]);
            $r->setPag_recebeucom_din_chq_cart($stmt["pag_recebeucom_din_chq_cart"]);
            $r->setPag_sementrada_comentrada($stmt["pag_sementrada_comentrada"]);
            $r->setPag_tipo_pagamento($stmt["pag_tipo_pagamento"]);
            $r->setPag_valor_recebido($stmt["pag_valor_recebido"]);
            $r->setVendac_chave($stmt["vendac_chave"]);

            return $r;
        } catch (PDOException $e) {
            print "[ Erro em m_buscar_confpagamento_por_chave :: " . $e->getMessage() . " ]";
        }
    }

    public function m_EXCLUIR_CONFPAGAMENTO_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from conf_pagamento where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_CONFPAGAMENTO_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}

?>
