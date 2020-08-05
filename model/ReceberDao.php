<?php

class ReceberDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ReceberDao();
        return self::$instance;
    }

    public function m_inserir_receber_exportado(ReceberBean $rec) {

        try {
            $sql = "insert into receber (ID_CPF_EMPRESA,                    
                    rec_num_parcela,
                    rec_cli_codigo,
                    rec_cli_nome,
                    vendac_chave,
                    rec_datamovimento,
                    rec_valorreceber,
                    rec_datavencimento,
                    rec_datavencimento_extenso,
                    rec_data_que_pagou,
                    rec_valor_pago,
                    rec_recebeu_com,
                    rec_parcelas_cartao,
                    rec_enviado) values (
                    
                    :ID_CPF_EMPRESA,                    
                    :rec_num_parcela,
                    :rec_cli_codigo,                   
                    :rec_cli_nome,
                    :vendac_chave,
                    :rec_datamovimento,                    
                    :rec_valorreceber,
                    :rec_datavencimento,
                    :rec_datavencimento_extenso,                        
                    :rec_data_que_pagou,
                    :rec_valor_pago,
                    :rec_recebeu_com,                    
                    :rec_parcelas_cartao,
                    :rec_enviado)";


            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":rec_num_parcela", $rec->getRec_num_parcela());
            $statement_sql->bindValue(":rec_cli_codigo", $rec->getRec_cli_codigo());
            $statement_sql->bindValue(":rec_cli_nome", $rec->getRec_cli_nome());
            $statement_sql->bindValue(":vendac_chave", $rec->getVendac_chave());
            $statement_sql->bindValue(":rec_datamovimento", $rec->getRec_datamovimento());
            $statement_sql->bindValue(":rec_valorreceber", $rec->getRec_valorreceber());
            $statement_sql->bindValue(":rec_datavencimento", $rec->getRec_datavencimento());
            $statement_sql->bindValue(":rec_datavencimento_extenso", $rec->getRec_datavencimento_extenso());
            $statement_sql->bindValue(":rec_data_que_pagou", $rec->getRec_data_que_pagou());
            $statement_sql->bindValue(":rec_valor_pago", $rec->getRec_valor_pago());
            $statement_sql->bindValue(":rec_recebeu_com", $rec->getRec_recebeu_com());
            $statement_sql->bindValue(":rec_parcelas_cartao", $rec->getRec_parcelas_cartao());
            $statement_sql->bindValue(":rec_enviado", $rec->getRec_enviado());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[ Erro em m_inserir_receber_exportado :: " . $e->getMessage();
        }
    }

    public function m_update_receber_exportado(ReceberBean $rec) {

        try {
            $sql = "update receber set ID_CPF_EMPRESA=:ID_CPF_EMPRESA,                    
                    rec_num_parcela=:rec_num_parcela,rec_cli_codigo=:rec_cli_codigo,rec_cli_nome=:rec_cli_nome,
                    vendac_chave=:vendac_chave,rec_datamovimento=:rec_datamovimento,rec_valorreceber=:rec_valorreceber,
                    rec_datavencimento=:rec_datavencimento,rec_datavencimento_extenso=:rec_datavencimento_extenso,
                    rec_data_que_pagou=:rec_data_que_pagou,rec_valor_pago=:rec_valor_pago,
                    rec_recebeu_com=:rec_recebeu_com, rec_parcelas_cartao=:rec_parcelas_cartao,
                    rec_enviado=:rec_enviado where ID_CPF_EMPRESA =:ID_CPF_EMPRESA and  vendac_chave=:vendac_chave and  rec_num_parcela=:rec_num_parcela ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":rec_num_parcela", $rec->getRec_num_parcela());
            $statement_sql->bindValue(":rec_cli_codigo", $rec->getRec_cli_codigo());
            $statement_sql->bindValue(":rec_cli_nome", $rec->getRec_cli_nome());
            $statement_sql->bindValue(":vendac_chave", $rec->getVendac_chave());
            $statement_sql->bindValue(":rec_datamovimento", $rec->getRec_datamovimento());
            $statement_sql->bindValue(":rec_valorreceber", $rec->getRec_valorreceber());
            $statement_sql->bindValue(":rec_datavencimento", $rec->getRec_datavencimento());
            $statement_sql->bindValue(":rec_datavencimento_extenso", $rec->getRec_datavencimento_extenso());
            $statement_sql->bindValue(":rec_data_que_pagou", $rec->getRec_data_que_pagou());
            $statement_sql->bindValue(":rec_valor_pago", $rec->getRec_valor_pago());
            $statement_sql->bindValue(":rec_recebeu_com", $rec->getRec_recebeu_com());
            $statement_sql->bindValue(":rec_parcelas_cartao", $rec->getRec_parcelas_cartao());
            $statement_sql->bindValue(":rec_enviado", $rec->getRec_enviado());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[ Erro em m_update_receber_exportado :: " . $e->getMessage();
        }
    }

    public function m_atualiza_codigo_cliente_offline_receber($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo) {
        try {
            $sql = "update receber set rec_cli_codigo=? where rec_cli_codigo=? and ID_CPF_EMPRESA=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $codigo_novo);
            $statement_sql->bindValue(2, $codigo_antigo);
            $statement_sql->bindValue(3, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[ Erro em m_atualiza_codigo_cliente_offline :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_contas_receber_por_vendac_chave(ReceberBean $rec) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = :ID_CPF_EMPRESA  and vendac_chave = :vendac_chave order by rec_datavencimento asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $rec->getVendac_chave());
            $statement_sql->execute();

            return $this->fetch_array_contas($statement_sql);
        } catch (PDOException $e) {
            print "[ Erro em m_buscar_todas_contas_receber_por_vendac_chave :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_contas_receber(ReceberBean $rec) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = ? order by rec_datavencimento asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $rec->getID_CPF_EMPRESA());

            $statement_sql->execute();

            return $this->fetch_array_contas($statement_sql);
        } catch (PDOException $e) {
            print "[ Erro em m_buscar_todas_contas_receber_por_vendac_chave :: " . $e->getMessage();
        }
    }

    public function m_buscar_conta_receber_por_chave_e_numparcela(ReceberBean $rec) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and vendac_chave = :vendac_chave and rec_num_parcela = :rec_num_parcela ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $rec->getVendac_chave());
            $statement_sql->bindValue(":rec_num_parcela", $rec->getRec_num_parcela());
            $statement_sql->execute();
            $r = new ReceberBean();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $r->setRec_num_parcela($stmt["rec_num_parcela"]);
            $r->setVendac_chave($stmt["vendac_chave"]);
            return $r;
        } catch (PDOException $e) {
            print "[ Erro em m_buscar_todas_contas_receber_por_chave_e_numparcela :: " . $e->getMessage();
        }
    }

    // ********************************************************************
    // CONSULTAS PARA RELATORIOS ADM
    // CONSULTAS PARA RELATORIOS ADM

    public function m_busca_contas_EM_ABERTO_por_rec_cli_codigo_ADM(ReceberBean $rec, $data_inicial, $data_final) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and rec_datavencimento  between  '$data_inicial' and '$data_final'   and rec_cli_codigo = :rec_cli_codigo and rec_valor_pago = 0  order by rec_datavencimento asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":rec_cli_codigo", $rec->getRec_cli_codigo());
            $statement_sql->execute();
            //$sqli = "select * from receber where ID_CPF_EMPRESA = '".$rec->getID_CPF_EMPRESA()."' and rec_datavencimento  between  '$data_inicial' and '$data_final'   and rec_cli_codigo = ".$rec->getRec_cli_codigo()." and rec_valor_pago = 0  order by rec_datavencimento asc ";
            //echo $sqli;
            return $this->fetch_array_contas($statement_sql);
        } catch (PDOException $e) {
            print "[ Erro em m_busca_contas_EM_ABERTO_por_rec_cli_codigo_ADM :: " . $e->getMessage();
        }
    }

    public function m_busca_contas_PAGAS_por_rec_cli_codigo_ADM(ReceberBean $rec, $data_inicial, $data_final) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and rec_datavencimento  between  '$data_inicial' and '$data_final' and rec_cli_codigo = :rec_cli_codigo  and rec_valor_pago > 0 order by rec_datavencimento asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":rec_cli_codigo", $rec->getRec_cli_codigo());
            $statement_sql->execute();
            //$sqli = "select * from receber where ID_CPF_EMPRESA = '".$rec->getID_CPF_EMPRESA()."' and rec_datavencimento  between  '$data_inicial' and '$data_final'   and rec_cli_codigo = ".$rec->getRec_cli_codigo()." and rec_valor_pago = 0  order by rec_datavencimento asc ";
            //echo $sqli;            
            return $this->fetch_array_contas($statement_sql);
        } catch (PDOException $e) {
            print "[ Erro em m_busca_contas_PAGAS_por_rec_cli_codigo_ADM :: " . $e->getMessage();
        }
    }

    public function m_busca_contas_TODAS_por_rec_cli_codigo_ADM(ReceberBean $rec, $data_inicial, $data_final) {
        try {
            $sql = "select * from receber where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and rec_datavencimento  between  '$data_inicial' and '$data_final'   and rec_cli_codigo = :rec_cli_codigo order by rec_datavencimento asc ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $rec->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":rec_cli_codigo", $rec->getRec_cli_codigo());
            $statement_sql->execute();
            //$sqli = "select * from receber where ID_CPF_EMPRESA = '".$rec->getID_CPF_EMPRESA()."' and rec_datavencimento  between  '$data_inicial' and '$data_final'   and rec_cli_codigo = ".$rec->getRec_cli_codigo()." and rec_valor_pago = 0  order by rec_datavencimento asc ";
            //echo $sqli;            
            return $this->fetch_array_contas($statement_sql);
        } catch (PDOException $e) {
            print "[ Erro em m_busca_contas_TODAS_por_rec_cli_codigo_ADM :: " . $e->getMessage();
        }
    }

    private function fetch_array_contas($statement_sql) {
        $resultado = array();
        if ($statement_sql) {
            while ($row = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $receber = new ReceberBean();
                $receber->setID_CPF_EMPRESA($row->ID_CPF_EMPRESA);
                $receber->setRec_num_parcela($row->rec_num_parcela);
                $receber->setRec_cli_codigo($row->rec_cli_codigo);
                $receber->setRec_cli_nome($row->rec_cli_nome);
                $receber->setVendac_chave($row->vendac_chave);
                $receber->setRec_datamovimento($row->rec_datamovimento);
                $receber->setRec_valorreceber($row->rec_valorreceber);
                $receber->setRec_datavencimento($row->rec_datavencimento);
                $receber->setRec_datavencimento_extenso($row->rec_datavencimento_extenso);
                $receber->setRec_data_que_pagou($row->rec_data_que_pagou);
                $receber->setRec_valor_pago($row->rec_valor_pago);
                $receber->setRec_recebeu_com($row->rec_recebeu_com);
                $receber->setRec_parcelas_cartao($row->rec_parcelas_cartao);
                $resultado[] = $receber;
            }
        }

        return $resultado;
    }

    public function m_EXCLUIR_RECEBER_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from receber where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_RECEBER_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}
?>

