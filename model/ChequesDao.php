<?php

class ChequesDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ChequesDao();
        return self::$instance;
    }

    public function m_inserir_cheque_exportado(ChequesBean $cheque) {

        try {
            $sql = "insert into cheques (ID_CPF_EMPRESA,chq_cli_codigo,chq_numerocheque,chq_telefone1,
                chq_telefone2,chq_cpf_dono,chq_nomedono,chq_nomebanco,chq_vencimento,chq_valorcheque,
                chq_terceiro,vendac_chave,chq_enviado,chq_dataCadastro)                 
                values
                (:ID_CPF_EMPRESA,:chq_cli_codigo,:chq_numerocheque,:chq_telefone1,
                :chq_telefone2,:chq_cpf_dono,:chq_nomedono,:chq_nomebanco,
                :chq_vencimento,:chq_valorcheque,:chq_terceiro,
                :vendac_chave,:chq_enviado,:chq_dataCadastro)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cheque->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":chq_cli_codigo", $cheque->getChq_cli_codigo());
            $statement_sql->bindValue(":chq_numerocheque", $cheque->getChq_numerocheque());
            $statement_sql->bindValue(":chq_telefone1", $cheque->getChq_telefone1());
            $statement_sql->bindValue(":chq_telefone2", $cheque->getChq_telefone2());
            $statement_sql->bindValue(":chq_cpf_dono", $cheque->getChq_cpf_dono());
            $statement_sql->bindValue(":chq_nomedono", $cheque->getChq_nomedono());
            $statement_sql->bindValue(":chq_nomebanco", $cheque->getChq_nomebanco());
            $statement_sql->bindValue(":chq_vencimento", $cheque->getChq_vencimento());
            $statement_sql->bindValue(":chq_valorcheque", $cheque->getChq_valorcheque());
            $statement_sql->bindValue(":chq_terceiro", $cheque->getChq_terceiro());
            $statement_sql->bindValue(":vendac_chave", $cheque->getVendac_chave());
            $statement_sql->bindValue(":chq_enviado", $cheque->getChq_enviado());
            $statement_sql->bindValue(":chq_dataCadastro", $cheque->getChq_dataCadastro());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[[[   Erro em m_inserir_cheque :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_todos_cheques(ChequesBean $cheque) {
        try {
            $sql = "select cli.ID_CPF_EMPRESA, "
                    . " chq.chq_codigo, "
                    . " chq.chq_cli_codigo, "
                    . " chq.chq_numerocheque, "
                    . " chq.chq_telefone1, "
                    . " chq.chq_telefone2, "
                    . " chq.chq_cpf_dono, "
                    . " chq.chq_nomedono,"
                    . " chq.chq_nomebanco,"
                    . " chq.chq_vencimento, "
                    . " chq.chq_valorcheque,"
                    . " chq.chq_terceiro, "
                    . " chq.chq_terceiro, "
                    . " chq.vendac_chave,"
                    . " chq.chq_dataCadastro,"
                    . " ifnull(cli.cli_nome,'nulo') as cli_nome   ,"
                    . " chq.chq_enviado "
                    . " from cheques chq "
                    . " left outer join clientes cli on cli.cli_codigo = chq.chq_cli_codigo"
                    . " where cli.ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cheque->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fech_array_cheques($statement_sql);
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_todos_cheques :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_cheque_por_vendac_chave(ChequesBean $cheque) {
        try {

            $sql = "SELECT * FROM cheques where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_chave = :vendac_chave";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cheque->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $cheque->getVendac_chave());

            $statement_sql->execute();
            $cheque = new ChequesBean();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $cheque->setVendac_chave($stmt["vendac_chave"]);
            $cheque->setChq_nomebanco($stmt["chq_nomebanco"]);
            $cheque->setChq_nomedono($stmt["chq_nomedono"]);
            $cheque->setChq_terceiro($stmt["chq_terceiro"]);
            $cheque->setChq_numerocheque($stmt["chq_numerocheque"]);
            $cheque->setChq_valorcheque($stmt["chq_valorcheque"]);
            $cheque->setChq_telefone1($stmt["chq_telefone1"]);
            $cheque->setChq_telefone2($stmt["chq_telefone2"]);

            return $cheque;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_cheque_por_vendac_chave :: " . $e->getMessage() . "   ]]]";
        }
    }

    private function fech_array_cheques($statement) {

        $results = array();
        if ($statement) {

            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {

                $cheque = new ChequesBean();
                $cheque->setID_CPF_EMPRESA($row->ID_CPF_EMPRESA);
                $cheque->setChq_codigo($row->chq_codigo);
                $cheque->setChq_cli_codigo($row->chq_cli_codigo);
                $cheque->setCli_nome($row->cli_nome);
                $cheque->setChq_numerocheque($row->chq_numerocheque);
                $cheque->setChq_telefone1($row->chq_telefone1);
                $cheque->setChq_telefone2($row->chq_telefone2);
                $cheque->setChq_cpf_dono($row->chq_cpf_dono);
                $cheque->setChq_nomedono($row->chq_nomedono);
                $cheque->setChq_nomebanco($row->chq_nomebanco);
                $cheque->setChq_vencimento($row->chq_vencimento);
                $cheque->setChq_valorcheque($row->chq_valorcheque);
                $cheque->setChq_terceiro($row->chq_terceiro);
                $cheque->setVendac_chave($row->vendac_chave);
                $cheque->setChq_enviado($row->chq_enviado);
                $cheque->setChq_dataCadastro($row->chq_dataCadastro);


                $results[] = $cheque;
            }
        }
        return $results;
    }

    public function m_EXCLUIR_CHEQUES_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from cheques where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluir_empresa_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_atualiza_codigo_cliente_offline_cheque($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo) {
        try {
            $sql = "update cheques set chq_cli_codigo=? where chq_cli_codigo=? and ID_CPF_EMPRESA=? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $codigo_novo);
            $statement_sql->bindValue(2, $codigo_antigo);
            $statement_sql->bindValue(3, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[ Erro em m_atualiza_codigo_cliente_offline :: " . $e->getMessage();
        }
    }

}

?>
