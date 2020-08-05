<?php

class PermissoesInstance {

    function __construct() {
        
    }

    public function c_gravaPermissao_quando_existe_criacao_de_NOVAS_tabelas_no_banco_de_dados($incluir, $visualizar, $alterar, $excluir, $nome_tabela, $per_nivel) {
        $permissoes = new PermissoesBean();
        $permissoes->setNome_tabela($nome_tabela);
        $permissoes->setPer_incluir($incluir);
        $permissoes->setPer_visualizar($visualizar);
        $permissoes->setPer_alterar($alterar);
        $permissoes->setPer_excluir($excluir);
        $permissoes->setLog_numerocelular($_SESSION["usu_numerocelular"]);
        $permissoes->setUsu_celularkey($_SESSION["usu_celularkey"]);
        $permissoes->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $permissoes->setPer_nivel($per_nivel);
        return PermissoesDao::getInstance()->m_gravaPermissao($permissoes);
    }

    public function c_gravaPermissao($nome_tabela, $per_nivel) {
        $permissoes = new PermissoesBean();
        $permissoes->setNome_tabela($nome_tabela);
        $permissoes->setPer_incluir("S");
        $permissoes->setPer_alterar("S");
        $permissoes->setPer_excluir("N");
        $permissoes->setPer_visualizar("S");
        $permissoes->setLog_numerocelular($_POST["emp_numerocelular"]);
        $permissoes->setUsu_celularkey($_POST["emp_celularkey"]);
        $permissoes->setID_CPF_EMPRESA($_POST["emp_cpf"]);
        $permissoes->setPer_nivel($per_nivel);
        return PermissoesDao::getInstance()->m_gravaPermissao($permissoes);
    }

    public function c_atualizarPermisssoes() {
        $permissoes = new PermissoesBean();
        $permissoes->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $permissoes->setLog_numerocelular($_POST["log_numerocelular"]);
        $permissoes->setNome_tabela($_POST["nome_tabela"]);
        $permissoes->setPer_incluir($_POST["per_incluir"]);
        $permissoes->setPer_alterar($_POST["per_alterar"]);
        $permissoes->setPer_visualizar($_POST["per_visualizar"]);
        $permissoes->setPer_excluir($_POST["per_excluir"]);
        return PermissoesDao::getInstance()->m_atualizarPermisssoes($permissoes);
    }

    public function c_atualizarPermisssoes_GET() {
        $permissoes = new PermissoesBean();
        $permissoes->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $permissoes->setPer_incluir($_GET["per_incluir"]);
        $permissoes->setPer_alterar($_GET["per_alterar"]);
        $permissoes->setPer_visualizar($_GET["per_visualizar"]);
        $permissoes->setPer_excluir($_GET["per_excluir"]);
        $permissoes->setUsu_celularkey($_GET["usu_celularkey"]);
        $permissoes->setNome_tabela($_GET["nome_tabela"]);
        return PermissoesDao::getInstance()->m_atualizarPermisssoes($permissoes);
    }

    public function C_grava_nova_Permissao_se_cpf_empresa_ja_existe($nome_tabela, $incluir, $alterar, $visualizar, $excluir, $per_nivel) {

        $permissoes = new PermissoesBean();
        $permissoes->setNome_tabela($nome_tabela);
        $permissoes->setPer_incluir($incluir);
        $permissoes->setPer_visualizar($visualizar);
        $permissoes->setPer_alterar($alterar);
        $permissoes->setPer_excluir($excluir);
        $permissoes->setLog_numerocelular($_POST["emp_numerocelular"]);
        $permissoes->setUsu_celularkey($_POST["emp_celularkey"]);
        $permissoes->setID_CPF_EMPRESA($_POST["emp_cpf"]);
        $permissoes->setPer_nivel($per_nivel);
        return PermissoesDao::getInstance()->m_gravaPermissao($permissoes);
    }

    public function c_busca_permissoes_do_usuario_selecionado($usu_celularkey, $ID_CPF_EMPRESA) {
        $permissoes = new PermissoesBean();
        $permissoes->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $permissoes->setUsu_celularkey($usu_celularkey);
        return PermissoesDao::getInstance()->m_busca_permissoes_do_usuario_selecionado($permissoes);
    }

    public function c_buscarPermParaTabelaDe($nome_tabela) {
        $permissoes = new PermissoesBean();
        $permissoes->setNome_tabela($nome_tabela);
        $permissoes->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $permissoes->setUsu_celularkey($_SESSION["usu_celularkey"]);
        return PermissoesDao::getInstance()->m_buscarPermParaTabelaDe($permissoes);
    }

    public function c_SelecionaPermissoesMinhaEmpresa($ID_CPF_EMPRESA) {
        $permissoes = new PermissoesBean();
        $permissoes->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return PermissoesDao::getInstance()->m_SelecionaPermissoesMinhaEmpresa($permissoes);
    }

    public function c_SelecionaPermissoes_USER($ID_CPF_EMPRESA, $log_numerocelular) {
        $permissoes = new PermissoesBean();
        $permissoes->setLog_numerocelular($log_numerocelular);
        $permissoes->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return PermissoesDao::getInstance()->m_SelecionaPermissoes_USER($permissoes);
    }

    public function c_busca_todas_permissoes_para_diretor_do_sistema() {
        return PermissoesDao::getInstance()->m_busca_todas_permissoes_para_diretor_do_sistema();
    }

}

?>
