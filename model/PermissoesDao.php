<?php

class PermissoesDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new PermissoesDao();
        return self::$instance;
    }

    public function m_gravaPermissao(PermissoesBean $permissao) {

        try {

            $sql = "insert into permissoes ("
                    . "nome_tabela,"
                    . "log_numerocelular,"
                    . "usu_celularkey,"
                    . "per_incluir,"
                    . "per_alterar,"
                    . "per_visualizar,"
                    . "per_excluir,"
                    . "ID_CPF_EMPRESA,"
                    . "per_nivel) "
                    . "VALUES ("
                    . ":nome_tabela,"
                    . ":log_numerocelular,"
                    . ":usu_celularkey,"
                    . ":per_incluir,"
                    . ":per_alterar,"
                    . ":per_visualizar,"
                    . ":per_excluir,"
                    . ":ID_CPF_EMPRESA,"
                    . ":per_nivel);";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":nome_tabela", $permissao->getNome_tabela());
            $statement_sql->bindValue(":log_numerocelular", $permissao->getLog_numerocelular());
            $statement_sql->bindValue(":usu_celularkey", $permissao->getUsu_celularkey());
            $statement_sql->bindValue(":per_incluir", $permissao->getPer_incluir());
            $statement_sql->bindValue(":per_alterar", $permissao->getPer_alterar());
            $statement_sql->bindValue(":per_visualizar", $permissao->getPer_visualizar());
            $statement_sql->bindValue(":per_excluir", $permissao->getPer_excluir());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":per_nivel", $permissao->getPer_nivel());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravaPermissao :: " . $e->getMessage();
        }
    }

    public function m_SelecionaPermissoesMinhaEmpresa(PermissoesBean $permissao) {

        try {
            $sql = "select distinct log_numerocelular,usu_celularkey from permissoes where ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fech_array_permissoes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_SelecionaPermissoesMinhaEmpresa :: " . $e->getMessage();
        }
    }

    public function m_SelecionaPermissoes_USER(PermissoesBean $permissao) {

        try {
            $sql = "select distinct log_numerocelular from permissoes where ID_CPF_EMPRESA = :ID_CPF_EMPRESA AND log_numerocelular = :log_numerocelular ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":log_numerocelular", $permissao->getLog_numerocelular());
            $statement_sql->execute();
            return $this->fech_array_permissoes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_SelecionaPermissoes_USER :: " . $e->getMessage();
        }
    }

    public function m_busca_todas_permissoes_para_diretor_do_sistema() {
        try {
            $sql = "select distinct log_numerocelular,usu_celularkey from permissoes";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fech_array_permissoes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_SelecionaPermissoesMinhaEmpresa :: " . $e->getMessage();
        }
    }

    public function m_buscarPermParaTabelaDe(PermissoesBean $permissao) {

        try {
            $sql = "select * from permissoes where ID_CPF_EMPRESA = :ID_CPF_EMPRESA  and  nome_tabela = :nome_tabela and  usu_celularkey = :usu_celularkey  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":nome_tabela", $permissao->getNome_tabela());
            $statement_sql->bindValue(":usu_celularkey", $permissao->getUsu_celularkey());

            $statement_sql->execute();
            return $this->popula_permissoes($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscarPermParaTabelaDe :: " . $e->getMessage();
        }
    }

    public function popula_permissoes($linha) {

        $permissao = new PermissoesBean();
        $permissao->setNome_tabela($linha["nome_tabela"]);
        $permissao->setLog_numerocelular($linha["log_numerocelular"]);
        $permissao->setUsu_celularkey($linha["usu_celularkey"]);
        $permissao->setID_CPF_EMPRESA($linha["ID_CPF_EMPRESA"]);
        $permissao->setPer_incluir($linha["per_incluir"]);
        $permissao->setPer_excluir($linha["per_excluir"]);
        $permissao->setPer_alterar($linha["per_alterar"]);
        $permissao->setPer_visualizar($linha["per_visualizar"]);
        $permissao->setPer_nivel($linha["per_nivel"]);
        return $permissao;
    }

    public function m_busca_permissoes_do_usuario_selecionado(PermissoesBean $permissao) {
        try {

            $sql = "select * from permissoes where ID_CPF_EMPRESA =  :ID_CPF_EMPRESA 
			and  usu_celularkey = :usu_celularkey  
			and  nome_tabela not like 'EMPRESA'  
			and  nome_tabela not like 'IMAGENSPRD'  			
                        and  nome_tabela not like 'CIDADES' 
			and  nome_tabela not like 'TABELAS'
                        and  nome_tabela not like 'FIREBASE_DEVICES'
                        and  nome_tabela not like 'ENTRADA_PRODUTOS'
                        and  nome_tabela not like 'ENTRADA_PRODUTOS_D'
                        and  nome_tabela not like 'EMPRESA_CONFIG' 
                        and  nome_tabela not like 'PERMISSOES'   
			and  nome_tabela not like 'VENDAD' 
                        and  nome_tabela not like 'LOGOMARCAS'
                        and  nome_tabela not like 'CONF_PAGAMENTO'                        
                        and  nome_tabela not like 'CHAVE_DE_LICENCA' 
			";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $permissao->getUsu_celularkey());
            $statement_sql->execute();
            return $this->fech_array_permissoes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscarPermUsuarioPeloNumeroTelefone :: " . $e->getMessage();
        }
    }

    private function fech_array_permissoes($statement) {
        $results = array();
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {

                $permissao = new PermissoesBean();
                $permissao->setPer_codigo($row->per_codigo);
                $permissao->setNome_tabela($row->nome_tabela);
                $permissao->setLog_numerocelular($row->log_numerocelular);
                $permissao->setUsu_celularkey($row->usu_celularkey);
                $permissao->setID_CPF_EMPRESA($row->ID_CPF_EMPRESA);
                $permissao->setPer_incluir($row->per_incluir);
                $permissao->setPer_excluir($row->per_excluir);
                $permissao->setPer_alterar($row->per_alterar);
                $permissao->setPer_visualizar($row->per_visualizar);
                $permissao->setPer_nivel($row->per_nivel);
                $results[] = $permissao;
            }
        }
        return $results;
    }

    public function m_atualizarPermisssoes(PermissoesBean $permissao) {

        try {

            $sql = "update permissoes set per_incluir=:per_incluir , per_alterar=:per_alterar,per_visualizar=:per_visualizar,per_excluir=:per_excluir  where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and usu_celularkey=:usu_celularkey and nome_tabela=:nome_tabela  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":per_incluir", $permissao->getPer_incluir());
            $statement_sql->bindValue(":per_alterar", $permissao->getPer_alterar());
            $statement_sql->bindValue(":per_visualizar", $permissao->getPer_visualizar());
            $statement_sql->bindValue(":per_excluir", $permissao->getPer_excluir());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $permissao->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $permissao->getUsu_celularkey());
            $statement_sql->bindValue(":nome_tabela", $permissao->getNome_tabela());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualizarPermisssoes :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_PERMISSOES_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from permissoes where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_PERMISSOES_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}
?>

