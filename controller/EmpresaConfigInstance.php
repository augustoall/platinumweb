<?php

class EmpresaConfigInstance {

    function __construct() {
        
    }

    static public function c_insert() {
        $dados = array(
            'ID_CPF_EMPRESA' => $_POST["ID_CPF_EMPRESA"],
            'emp_razaosocial' => $_POST["emp_razaosocial"],
            'emp_nomefantasia' => $_POST["emp_nomefantasia"],
            'emp_ie' => $_POST["emp_ie"],
            'emp_iest' => $_POST["emp_iest"],
            'emp_insc_mun' => $_POST["emp_insc_mun"],
            'emp_cnae' => $_POST["emp_cnae"],
            'emp_crt' => $_POST["emp_crt"],
            'emp_cnpj' => $_POST["emp_cnpj"],
            'emp_cpf' => $_POST["emp_cpf"],
            'emp_endereco' => $_POST["emp_endereco"],
            'emp_numero' => $_POST["emp_numero"],
            'emp_complemento' => $_POST["emp_complemento"],
            'emp_bairro' => $_POST["emp_bairro"],
            'emp_cod_municipio' => $_POST["emp_cod_municipio"],
            'emp_nome_municipio' => $_POST["emp_nome_municipio"],
            'emp_sigla_uf' => $_POST["emp_sigla_uf"],
            'emp_codigo_estado' => $_POST["emp_codigo_estado"],
            'emp_cep' => $_POST["emp_cep"],
            'emp_nome_pais' => $_POST["emp_nome_pais"],
            'emp_cod_pais' => $_POST["emp_cod_pais"],
            'emp_contato1' => $_POST["emp_contato1"],
            'emp_contato2' => $_POST["emp_contato2"],
            'emp_email' => $_POST["emp_email"],
            'emp_facebook' => $_POST["emp_facebook"],
            'emp_siteurl' => $_POST["emp_siteurl"]
        );
        return Crud::getInstance('empresa_config')->insert($dados);
    }

    static public function c_update() {
        $dados = array(
            'emp_id' => $_POST["emp_id"],
            'ID_CPF_EMPRESA' => $_POST["ID_CPF_EMPRESA"],
            'emp_razaosocial' => $_POST["emp_razaosocial"],
            'emp_nomefantasia' => $_POST["emp_nomefantasia"],
            'emp_ie' => $_POST["emp_ie"],
            'emp_iest' => $_POST["emp_iest"],
            'emp_insc_mun' => $_POST["emp_insc_mun"],
            'emp_cnae' => $_POST["emp_cnae"],
            'emp_crt' => $_POST["emp_crt"],
            'emp_cnpj' => $_POST["emp_cnpj"],
            'emp_cpf' => $_POST["emp_cpf"],
            'emp_endereco' => $_POST["emp_endereco"],
            'emp_numero' => $_POST["emp_numero"],
            'emp_complemento' => $_POST["emp_complemento"],
            'emp_bairro' => $_POST["emp_bairro"],
            'emp_cod_municipio' => $_POST["emp_cod_municipio"],
            'emp_nome_municipio' => $_POST["emp_nome_municipio"],
            'emp_sigla_uf' => $_POST["emp_sigla_uf"],
            'emp_codigo_estado' => $_POST["emp_codigo_estado"],
            'emp_cep' => $_POST["emp_cep"],
            'emp_nome_pais' => $_POST["emp_nome_pais"],
            'emp_cod_pais' => $_POST["emp_cod_pais"],
            'emp_contato1' => $_POST["emp_contato1"],
            'emp_contato2' => $_POST["emp_contato2"],
            'emp_email' => $_POST["emp_email"],
            'emp_facebook' => $_POST["emp_facebook"],
            'emp_siteurl' => $_POST["emp_siteurl"]);
        $condicao = array('ID_CPF_EMPRESA=' => $_SESSION["ID_CPF_EMPRESA"]);
        return Crud::getInstance('empresa_config')->update($dados, $condicao);
    }

    public function c_busca_empresa_config($ID_CPF_EMPRESA) {
        return EmpresaConfigDao::getInstance()->m_busca_empresa_config($ID_CPF_EMPRESA);
    }

}
