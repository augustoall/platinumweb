<?php

class EmpresaConfigDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EmpresaConfigDao ();
        return self::$instance;
    }

    public function m_busca_empresa_config($ID_CPF_EMPRESA) {
        try {
            $sql = "select * from empresa_config where ID_CPF_EMPRESA = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $ID_CPF_EMPRESA);
            $statement_sql->execute();
            return $this->popula_empresa($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[[   Erro em m_empresa_config :: " . $e->getMessage() . "   ]]]";
        }
    }

    private function popula_empresa($linha) {
        $empresa = new EmpresaConfigBean();
        $empresa->setEmp_id($linha["emp_id"]);        
        $empresa->setID_CPF_EMPRESA(["ID_CPF_EMPRESA"]);
        $empresa->setEmp_razaosocial($linha["emp_razaosocial"]);
        $empresa->setEmp_nomefantasia($linha["emp_nomefantasia"]);
        $empresa->setEmp_ie($linha["emp_ie"]);
        $empresa->setEmp_iest($linha["emp_iest"]);
        $empresa->setEmp_insc_mun($linha["emp_insc_mun"]);
        $empresa->setEmp_cnae($linha["emp_cnae"]);
        $empresa->setEmp_crt($linha["emp_crt"]);
        $empresa->setEmp_cnpj($linha["emp_cnpj"]);
        $empresa->setEmp_cpf($linha["emp_cpf"]);
        $empresa->setEmp_endereco($linha["emp_endereco"]);
        $empresa->setEmp_numero($linha["emp_numero"]);
        $empresa->setEmp_complemento($linha["emp_complemento"]);
        $empresa->setEmp_bairro($linha["emp_bairro"]);
        $empresa->setEmp_cod_municipio($linha["emp_cod_municipio"]);
        $empresa->setEmp_nome_municipio($linha["emp_nome_municipio"]);
        $empresa->setEmp_sigla_uf($linha["emp_sigla_uf"]);
        $empresa->setEmp_cep($linha["emp_cep"]);
        $empresa->setEmp_nome_pais($linha["emp_nome_pais"]);
        $empresa->setEmp_cod_pais($linha["emp_cod_pais"]);
        $empresa->setEmp_contato1($linha["emp_contato1"]);
        $empresa->setEmp_contato2($linha["emp_contato2"]);
        $empresa->setEmp_email($linha["emp_email"]);
        $empresa->setEmp_facebook($linha["emp_facebook"]);
        $empresa->setEmp_siteurl($linha["emp_siteurl"]); 
        $empresa->setEmp_codigo_estado($linha["emp_codigo_estado"]);  
        return $empresa;
    }

}
