<?php

class HistoricoPgtoDao {

    public static $instance;

    public function __construct() {
        
    }
    
    

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new HistoricoPgtoDao();
        return self::$instance;
    }

    public function m_inserir_historicoPgto_exportado(HistoricoPgtoBean $hist) {

        try {
            $sql = "INSERT INTO historico_pagamento (ID_CPF_EMPRESA,hist_numero_parcela, hist_valor_real_parcela, hist_valor_pago_no_dia, hist_restante_a_pagar, hist_datapagamento, hist_nomecliente, hist_pagou_com, vendac_chave, hist_enviado,usu_celularkey) VALUES (:ID_CPF_EMPRESA,:hist_numero_parcela, :hist_valor_real_parcela, :hist_valor_pago_no_dia, :hist_restante_a_pagar, :hist_datapagamento, :hist_nomecliente, :hist_pagou_com, :vendac_chave, :hist_enviado,:usu_celularkey);";
            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":hist_numero_parcela", $hist->getHist_numero_parcela());
            $statement_sql->bindValue(":hist_valor_real_parcela", $hist->getHist_valor_real_parcela());
            $statement_sql->bindValue(":hist_valor_pago_no_dia", $hist->getHist_valor_pago_no_dia());
            $statement_sql->bindValue(":hist_restante_a_pagar", $hist->getHist_restante_a_pagar());
            $statement_sql->bindValue(":hist_datapagamento", $hist->getHist_datapagamento());
            $statement_sql->bindValue(":hist_nomecliente", $hist->getHist_nomecliente());
            $statement_sql->bindValue(":hist_pagou_com", $hist->getHist_pagou_com());
            $statement_sql->bindValue(":vendac_chave", $hist->getVendac_chave());
            $statement_sql->bindValue(":hist_enviado", $hist->getHist_enviado());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $hist->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $hist->getUsu_celularkey());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[[[   Erro em m_inserir_historicoPgto_exportado :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_excluirHistoricosPgto(HistoricoPgtoBean $hist) {
        try {
            $sql = "delete from historico_pagamento where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and usu_celularkey = :usu_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $hist->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $hist->getUsu_celularkey());
            $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluirHistoricosPgto :: " . $e->getMessage();
        }
    }

    public function m_buscar_apenas_historicos_vendedor(HistoricoPgtoBean $hist) {
        try {
            $sql = "select * from historico_pagamento where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and usu_celularkey = :usu_celularkey order by hist_nomecliente,hist_numero_parcela,hist_datapagamento ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $hist->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $hist->getUsu_celularkey());
            $statement_sql->execute();
            $resultado = array();
            if ($statement_sql) {
                while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $hi = new HistoricoPgtoBean();
                    $hi->setHist_numero_parcela($row->hist_numero_parcela);
                    $hi->setHist_valor_real_parcela($row->hist_valor_real_parcela);
                    $hi->setHist_valor_pago_no_dia($row->hist_valor_pago_no_dia);
                    $hi->setHist_restante_a_pagar($row->hist_restante_a_pagar);
                    $hi->setHist_datapagamento($row->hist_datapagamento);
                    $hi->setHist_nomecliente($row->hist_nomecliente);
                    $hi->setHist_pagou_com($row->hist_pagou_com);
                    $resultado[] = $hi;
                }
            }

            return $resultado;
        } catch (PDOException $e) {
            print "Erro em m_buscar_apenas_historicos_vendedor :: " . $e->getMessage();
        }
    }

    public function m_buscar_historicos_adm(HistoricoPgtoBean $hist) {
        try {
            $sql = "select * from historico_pagamento where ID_CPF_EMPRESA = :ID_CPF_EMPRESA order by vendac_chave,hist_numero_parcela,hist_nomecliente,hist_datapagamento";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $hist->getID_CPF_EMPRESA());
            $statement_sql->execute();
            $resultado = array();
            if ($statement_sql) {
                while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $hi = new HistoricoPgtoBean();
                    $hi->setHist_numero_parcela($row->hist_numero_parcela);
                    $hi->setHist_valor_real_parcela($row->hist_valor_real_parcela);
                    $hi->setHist_valor_pago_no_dia($row->hist_valor_pago_no_dia);
                    $hi->setHist_restante_a_pagar($row->hist_restante_a_pagar);
                    $hi->setHist_datapagamento($row->hist_datapagamento);
                    $hi->setHist_nomecliente($row->hist_nomecliente);
                    $hi->setHist_pagou_com($row->hist_pagou_com);
                    $hi->setVendac_chave($row->vendac_chave);

                    $resultado[] = $hi;
                }
            }

            return $resultado;
        } catch (PDOException $e) {
            print "Erro em m_buscar_apenas_historicos_adm :: " . $e->getMessage();
        }
    }

    public function m_buscar_historicos_diretor() {
        try {
            $sql = "select * from historico_pagamento order by hist_nomecliente,hist_numero_parcela,hist_datapagamento ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            $resultado = array();
            if ($statement_sql) {
                while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $hi = new HistoricoPgtoBean();
                    $hi->setHist_numero_parcela($row->hist_numero_parcela);
                    $hi->setHist_valor_real_parcela($row->hist_valor_real_parcela);
                    $hi->setHist_valor_pago_no_dia($row->hist_valor_pago_no_dia);
                    $hi->setHist_restante_a_pagar($row->hist_restante_a_pagar);
                    $hi->setHist_datapagamento($row->hist_datapagamento);
                    $hi->setHist_nomecliente($row->hist_nomecliente);
                    $hi->setHist_pagou_com($row->hist_pagou_com);
                    $resultado[] = $hi;
                }
            }

            return $resultado;
        } catch (PDOException $e) {
            print "Erro em m_buscar_apenas_historicos_adm :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_HISTORICOPAGAMENTO_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from historico_pagamento where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_HISTORICOPAGAMENTO_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}
?>

