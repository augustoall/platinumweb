<?php

class EmpresaDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EmpresaDao();
        return self::$instance;
    }

    public function m_GravaEmpresa(EmpresaBean $emp) {


        try {
            $sql = "insert into empresa (
            emp_nome,emp_cpf,emp_licenca,emp_fim,
            emp_inicio,emp_celularkey,usu_codigo,
            emp_datapedido,emp_totalemdias,emp_numerocelular,
            emp_email)             
            values (            
            :emp_nome,:emp_cpf,:emp_licenca,:emp_fim,
            :emp_inicio,:emp_celularkey,:usu_codigo,
            :emp_datapedido,:emp_totalemdias,:emp_numerocelular,:emp_email)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":emp_nome", $emp->getEmp_nome());
            $statement_sql->bindValue(":emp_cpf", $emp->getEmp_cpf());
            $statement_sql->bindValue(":emp_licenca", $emp->getEmp_licenca());

            $statement_sql->bindValue(":emp_fim", $emp->getEmp_fim());
            $statement_sql->bindValue(":emp_inicio", $emp->getEmp_inicio());
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());

            $statement_sql->bindValue(":usu_codigo", $emp->getUsu_codigo());
            $statement_sql->bindValue(":emp_datapedido", $emp->getEmp_datapedido());
            $statement_sql->bindValue(":emp_totalemdias", $emp->getEmp_totalemdias());

            $statement_sql->bindValue(":emp_numerocelular", $emp->getEmp_numerocelular());
            $statement_sql->bindValue(":emp_email", $emp->getEmp_email());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_gravaEmpresa :: " . $e->getMessage();
        }
    }

    public function m_atualiza_empresa_na_administracao(EmpresaBean $emp) {


        try {
            $sql = "update empresa set 
            emp_codigo=:emp_codigo,
            emp_nome=:emp_nome,
            emp_cpf=:emp_cpf,
            emp_licenca=:emp_licenca,
            emp_fim=:emp_fim,
            emp_inicio=:emp_inicio,
            emp_celularkey=:emp_celularkey,
            usu_codigo=:usu_codigo,
            emp_datapedido=:emp_datapedido,
            emp_totalemdias=:emp_totalemdias,
            emp_numerocelular=:emp_numerocelular,
            emp_email=:emp_email  where emp_codigo =:emp_codigo   ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":emp_nome", $emp->getEmp_nome());
            $statement_sql->bindValue(":emp_cpf", $emp->getEmp_cpf());
            $statement_sql->bindValue(":emp_licenca", $emp->getEmp_licenca());

            $statement_sql->bindValue(":emp_fim", $emp->getEmp_fim());
            $statement_sql->bindValue(":emp_inicio", $emp->getEmp_inicio());
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());

            $statement_sql->bindValue(":usu_codigo", $emp->getUsu_codigo());
            $statement_sql->bindValue(":emp_datapedido", $emp->getEmp_datapedido());
            $statement_sql->bindValue(":emp_totalemdias", $emp->getEmp_totalemdias());

            $statement_sql->bindValue(":emp_numerocelular", $emp->getEmp_numerocelular());
            $statement_sql->bindValue(":emp_email", $emp->getEmp_email());

            $statement_sql->bindValue(":emp_codigo", $emp->getEmp_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualiza_empresa_na_administracao :: " . $e->getMessage();
        }
    }

    public function M_getEmpresaWhereEmp_celularkeyReturn(EmpresaBean $emp) {
        try {
            $sql = "SELECT * FROM empresa where emp_celularkey = :emp_celularkey  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());
            $statement_sql->execute();
            return $this->populaempresa($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $ex) {
            print "Erro em M_getEmpresaWhereEmp_celularkeyReturn :: " . $e->getMessage();
        }
    }

//55b43a63af869bee
    public function m_bsuca_empresa_por_codigo(EmpresaBean $emp) {
        try {
            $sql = "select emp.emp_codigo,"
                    . "emp.emp_nome, "
                    . "emp.emp_cpf, "
                    . "emp.emp_licenca, "
                    . "emp.emp_inicio, "
                    . "emp.emp_fim, "
                    . "emp.emp_celularkey, "
                    . "emp.usu_codigo, "
                    . "emp.emp_datapedido, "
                    . "emp.emp_totalemdias, "
                    . "emp.emp_numerocelular, "
                    . "emp.emp_email, "
                    . "usu.usu_nome, "
                    . "usu.usu_email, "
                    . "usu.usu_liberado, "
                    . "usu.usu_numerocelular, "
                    . "usu.usu_cpf "
                    . "from empresa emp left outer join usuarios usu "
                    . "on usu.usu_celularkey = emp.emp_celularkey where emp.emp_codigo = :emp_codigo ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_codigo", $emp->getEmp_codigo());
            $statement_sql->execute();
            return $this->populaempresa_com_data_br($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $ex) {
            print "Erro em m_bsuca_todas_empresas_por_codigo :: " . $e->getMessage();
        }
    }

    public function m_bsuca_todas_empresas_para_administracao() {
        try {
            $sql = "select * from empresa";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_empresas($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_bsuca_todas_empresas_para_administracao :: " . $e->getMessage();
        }
    }

    private function fetch_array_empresas($statement) {

        $results = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {

                $empresa = new EmpresaBean();
                $empresa->setEmp_codigo($row->emp_codigo);

                $empresa->setEmp_nome($row->emp_nome);
                $empresa->setEmp_cpf($row->emp_cpf);
                $empresa->setEmp_licenca($row->emp_licenca);

                $empresa->setEmp_fim(Util::format_DD_MM_AAAA($row->emp_fim));
                $empresa->setEmp_inicio(Util::format_DD_MM_AAAA($row->emp_inicio));
                $empresa->setEmp_celularkey($row->emp_celularkey);

                $empresa->setUsu_codigo($row->usu_codigo);
                $empresa->setEmp_datapedido(Util::format_DD_MM_AAAA($row->emp_datapedido));
                $empresa->setEmp_totalemdias($row->emp_totalemdias);

                $empresa->setEmp_numerocelular($row->emp_numerocelular);
                $empresa->setEmp_email($row->emp_email);

                $empresa->setNome_usuario($row->usu_nome);
                $empresa->setEmail_usuario($row->usu_email);
                $empresa->setLiberado($row->usu_liberado);
                $empresa->setNumero_celular($row->usu_numerocelular);
                $empresa->setCpf_usuario($row->usu_cpf);

                $results[] = $empresa;
            }
        }

        return $results;
    }

    public function populaempresa_com_data_br($linha) {

        $empresa = new EmpresaBean();
        $empresa->setEmp_codigo($linha["emp_codigo"]);

        $empresa->setEmp_nome($linha["emp_nome"]);
        $empresa->setEmp_cpf($linha["emp_cpf"]);
        $empresa->setEmp_licenca($linha["emp_licenca"]);

        $empresa->setEmp_fim(Util::format_DD_MM_AAAA($linha["emp_fim"]));
        $empresa->setEmp_inicio(Util::format_DD_MM_AAAA($linha["emp_inicio"]));
        $empresa->setEmp_celularkey($linha["emp_celularkey"]);

        $empresa->setUsu_codigo($linha["usu_codigo"]);
        $empresa->setEmp_datapedido($linha["emp_datapedido"]);
        $empresa->setEmp_totalemdias($linha["emp_totalemdias"]);

        $empresa->setEmp_numerocelular($linha["emp_numerocelular"]);
        $empresa->setEmp_email($linha["emp_email"]);


        $empresa->setNome_usuario($linha["usu_nome"]);
        $empresa->setEmail_usuario($linha["usu_email"]);
        $empresa->setLiberado($linha["usu_liberado"]);
        $empresa->setNumero_celular($linha["usu_numerocelular"]);
        $empresa->setCpf_usuario($linha["usu_cpf"]);

        return $empresa;
    }

    public function populaempresa($linha) {
        $empresa = new EmpresaBean();
        $empresa->setEmp_codigo($linha["emp_codigo"]);

        $empresa->setEmp_nome($linha["emp_nome"]);
        $empresa->setEmp_cpf($linha["emp_cpf"]);
        $empresa->setEmp_licenca($linha["emp_licenca"]);

        $empresa->setEmp_fim($linha["emp_fim"]);
        $empresa->setEmp_inicio($linha["emp_inicio"]);
        $empresa->setEmp_celularkey($linha["emp_celularkey"]);

        $empresa->setUsu_codigo($linha["usu_codigo"]);
        $empresa->setEmp_datapedido($linha["emp_datapedido"]);
        $empresa->setEmp_totalemdias($linha["emp_totalemdias"]);

        $empresa->setEmp_numerocelular($linha["emp_numerocelular"]);
        $empresa->setEmp_email($linha["emp_email"]);
        return $empresa;
    }

    public function m_busca_empresa_por_emp_celularkey(EmpresaBean $emp) {
        try {
            $sql = "SELECT * FROM empresa where emp_celularkey = :emp_celularkey  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());
            $statement_sql->execute();
            return $this->populaempresa($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $ex) {
            print "Erro em M_getEmpresaWhereEmp_celularkey :: " . $e->getMessage();
        }
    }

    public function M_updateKeyEmp(EmpresaBean $emp) {
        try {
            $sql = "update empresa set emp_licenca = :nova_chave, emp_fim = :nova_validade  where  emp_celularkey = :emp_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":nova_chave", $emp->getNewkey());
            $statement_sql->bindValue(":nova_validade", $emp->getNewdatevalidate());
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_updateKeyEmp :: " . $e->getMessage();
        }
    }

    public function M_updateEmp_celularkey(EmpresaBean $emp) {
        try {
            $sql = "update empresa set emp_licenca = :nova_chave  where  emp_celularkey = :emp_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":nova_chave", $emp->getNewkey());
            $statement_sql->bindValue(":emp_celularkey", $emp->getEmp_celularkey());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_updateEmp_celularkey :: " . $e->getMessage();
        }
    }

    public function M_verifica_se_cpf_empresa_ja_existe(EmpresaBean $emp) {
        try {
            $sql = "SELECT * FROM empresa WHERE emp_cpf = :emp_cpf  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_cpf", $emp->getEmp_cpf());
            $statement_sql->execute();

            return $this->populaempresa($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em M_verifica_se_cpf_empresa_ja_existe :: " . $e->getMessage();
        }
    }

    public function M_verifica_se_cpf_empresa_diretor_ja_existe(EmpresaBean $emp) {
        try {
            $sql = "SELECT * FROM empresa WHERE emp_cpf = :emp_cpf  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_cpf", $emp->getEmp_cpf());
            $statement_sql->execute();

            return $this->populaempresa($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em M_verifica_se_cpf_empresa_diretor_ja_existe :: " . $e->getMessage();
        }
    }

    public function M_atualiza_dias_licenca() {
        try {
            $sql = "update empresa set emp_inicio = Now();";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_atualiza_dias_licenca :: " . $e->getMessage();
        }
    }

    public function m_busca_empresa_por_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {

        try {
            $sql = "SELECT * FROM empresa WHERE emp_cpf = :emp_cpf  LIMIT 1 ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_cpf", $ID_CPF_EMPRESA);
            $statement_sql->execute();

            $empresa = new EmpresaBean();

            $linha = $statement_sql->fetch(PDO::FETCH_ASSOC);

            $empresa->setEmp_codigo($linha["emp_codigo"]);
            $empresa->setEmp_nome($linha["emp_nome"]);
            $empresa->setEmp_cpf($linha["emp_cpf"]);
            $empresa->setEmp_celularkey($linha["emp_celularkey"]);
            $empresa->setUsu_codigo($linha["usu_codigo"]);
            $empresa->setEmp_numerocelular($linha["emp_numerocelular"]);
            $empresa->setEmp_email($linha["emp_email"]);
            $empresa->setEmp_fim($linha["emp_fim"]);
            $empresa->setEmp_inicio($linha["emp_inicio"]);
            return $empresa;
        } catch (PDOException $e) {
            print "Erro em m_busca_empresa_por_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_EMPRESA_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from empresa where emp_cpf=:emp_cpf";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":emp_cpf", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_EMPRESA_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_busca_dias_de_acesso_empresa_DATEDIFF($emp_celularkey) {
        try {
            $sql = "SELECT  DATEDIFF(emp_fim,emp_inicio) as dias from empresa where emp_celularkey = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $emp_celularkey);
            $statement_sql->execute();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            return $stmt['dias'];
        } catch (PDOException $e) {
            print "Erro em m_busca_dias_do_aluno :: " . $e->getMessage();
        }
    }

}
?>

