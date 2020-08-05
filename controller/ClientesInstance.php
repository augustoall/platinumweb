<?php

class ClientesInstance {

    function __construct() {
        
    }

    public function c_imprime_relatorio_clientes_por_bairro() {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $cliBean->setCli_bairro($_POST["cli_bairro"]);
        $cliBean->setCid_nome($_POST["cid_nome"]);
        return ClientesDao::getInstance()->m_imprime_relatorio_clientes_por_bairro($cliBean);
    }

    public function c_imprime_relatorio_cliente_por_cidade() {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $cliBean->setCid_nome($_POST["cid_nome"]);
        return ClientesDao::getInstance()->m_imprime_relatorio_cliente_por_cidade($cliBean);
    }

    public function c_imprime_relatorio_cliente_por_vendedor() {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        $cliBean->setUsu_nome($_POST["usu_nome"]);
        return ClientesDao::getInstance()->m_imprime_relatorio_cliente_por_vendedor($cliBean);
    }

    public function c_grava_cliente($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $cliBean->setCli_endereco(Util::remover_letra_acentuada($_POST["cli_endereco"]));
        $cliBean->setCli_bairro(Util::remover_letra_acentuada($_POST["cli_bairro"]));
        $cliBean->setCli_fantasia(Util::remover_letra_acentuada($_POST["cli_fantasia"]));
        $cliBean->setCli_nome(Util::remover_letra_acentuada($_POST["cli_nome"]));
        $cliBean->setCli_observacao(Util::remover_letra_acentuada($_POST["cli_observacao"]));
        $cliBean->setCli_cep($_POST["cli_cep"]);
        $cliBean->setCid_codigo($_POST["cid_codigo"]);
        $cliBean->setCli_contato1($_POST["cli_contato1"]);
        $cliBean->setCli_contato2($_POST["cli_contato2"]);
        $cliBean->setCli_contato3($_POST["cli_contato3"]);
        $cliBean->setCli_nascimento($_POST["cli_nascimento"]);
        $cliBean->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliBean->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliBean->setCli_limite(str_replace(",", ".", $_POST["cli_limite"]));
        $cliBean->setCli_email(Util::remover_letra_acentuada($_POST["cli_email"]));
        $cliBean->setUsu_codigo($_POST["usu_codigo"]);
        $cliBean->setCli_senha($_POST["cli_senha"]);
        $cliBean->setCli_chave($_POST["cli_chave"]);

        // campos para nfe vazios para android
        $cliBean->setCli_indIEDest("#");
        $cliBean->setCli_IE("#");
        $cliBean->setCli_ISUF("#");
        $cliBean->setCli_IM("#");
        $cliBean->setCli_idEstrangeiro("#");
        $cliBean->setCli_numero("#");
        $cliBean->setCli_complemento("#");
        $cliBean->setCli_nomecidade("#");
        $cliBean->setCli_siglaestado("#");
        $cliBean->setCli_codPais("#");
        $cliBean->setCli_nomepais("#");
        return ClientesDao::getInstance()->m_grava_cliente($cliBean);
    }

    public function c_grava_cliente_web($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_endereco(Util::remover_letra_acentuada($_POST["cli_endereco"]));
        $cliBean->setCli_bairro(Util::remover_letra_acentuada($_POST["cli_bairro"]));
        $cliBean->setCli_fantasia(Util::remover_letra_acentuada($_POST["cli_fantasia"]));
        $cliBean->setCli_nome(Util::remover_letra_acentuada($_POST["cli_nome"]));
        $cliBean->setCli_observacao(Util::remover_letra_acentuada($_POST["cli_observacao"]));
        $cliBean->setCli_cep($_POST["cli_cep"]);
        $cliBean->setCid_codigo($_POST["cid_codigo"]);
        $cliBean->setCli_contato1($_POST["cli_contato1"]);
        $cliBean->setCli_contato2($_POST["cli_contato2"]);
        $cliBean->setCli_contato3($_POST["cli_contato3"]);
        $cliBean->setCli_nascimento(Util::format_AAAA_MM_DD($_POST["cli_nascimento"]));
        $cliBean->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliBean->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliBean->setCli_limite(str_replace(",", ".", $_POST["cli_limite"]));
        $cliBean->setCli_email(Util::remover_letra_acentuada($_POST["cli_email"]));
        $cliBean->setUsu_codigo($_POST["usu_codigo"]);
        $cliBean->setCli_senha($_POST["cli_senha"]);
        $cliBean->setCli_chave("");

        return ClientesDao::getInstance()->m_grava_cliente($cliBean);
    }

    public function c_alterar_cliente_web($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setCli_codigo($_POST["cli_codigo"]);
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_endereco(Util::remover_letra_acentuada($_POST["cli_endereco"]));
        $cliBean->setCli_bairro(Util::remover_letra_acentuada($_POST["cli_bairro"]));
        $cliBean->setCli_fantasia(Util::remover_letra_acentuada($_POST["cli_fantasia"]));
        $cliBean->setCli_nome(Util::remover_letra_acentuada($_POST["cli_nome"]));
        $cliBean->setCli_observacao(Util::remover_letra_acentuada($_POST["cli_observacao"]));
        $cliBean->setCli_cep($_POST["cli_cep"]);
        $cliBean->setCid_codigo($_POST["cid_codigo"]);
        $cliBean->setCli_contato1($_POST["cli_contato1"]);
        $cliBean->setCli_contato2($_POST["cli_contato2"]);
        $cliBean->setCli_contato3($_POST["cli_contato3"]);
        $cliBean->setCli_nascimento(Util::format_AAAA_MM_DD($_POST["cli_nascimento"]));
        $cliBean->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliBean->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliBean->setCli_limite(str_replace(",", ".", $_POST["cli_limite"]));
        $cliBean->setCli_email(Util::remover_letra_acentuada($_POST["cli_email"]));
        $cliBean->setUsu_codigo($_POST["usu_codigo"]);
        $cliBean->setCli_senha($_POST["cli_senha"]);
        $cliBean->setCli_chave("");
        return ClientesDao::getInstance()->m_alterar_cliente_web($cliBean);
    }

    public function c_verifica_se_cliente_existe($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_codigo($_POST["codigo_do_cliente"]);
        return ClientesDao::getInstance()->M_buscarClientePorCodigo($cliBean);
    }

    public function C_buscarClientePorCodigo($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_codigo($_GET ["cli_codigo"]);
        return ClientesDao::getInstance()->M_buscarClientePorCodigo($cliBean);
    }

    public function c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ClientesDao::getInstance()->m_busca_cliente_gravado_android_offline($cliBean);
    }

    public function c_buscaClientePorNome($ID_CPF_EMPRESA, $cli_nome) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_nome(trim($cli_nome));
        return ClientesDao::getInstance()->m_buscaClientePorNome($cliBean);
    }

    public function C_buscaClientePorCodigo($ID_CPF_EMPRESA, $cli_codigo) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_codigo($cli_codigo);
        return ClientesDao::getInstance()->M_buscarClientePorCodigo($cliBean);
    }

    public function C_buscarTodosClientes($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ClientesDao::getInstance()->M_buscaTodosClientes($cliBean);
    }

    public function c_listar_todos_clientes_para_diretor() {
        return ClientesDao::getInstance()->m_listar_todos_clientes_para_diretor();
    }

    public function c_buscar_apenas_clientes_do_vendedor() {
        $cliBean = new ClientesBean ();
        $cliBean->setUsu_codigo($_SESSION["usu_codigo"]);
        $cliBean->setID_CPF_EMPRESA($_SESSION["ID_CPF_EMPRESA"]);
        return ClientesDao::getInstance()->m_buscar_apenas_clientes_do_vendedor($cliBean);
    }

    public function C_buscaClientesDoVendedorUsuario($ID_CPF_EMPRESA, $usu_codigo) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setUsu_codigo($usu_codigo);
        return ClientesDao::getInstance()->M_buscaClientesDoVendedorUsuario($cliBean);
    }

    public function c_altera_cliente_cadastrado_offline($cli_codigo, $ID_CPF_EMPRESA) {
        return ClientesDao::getInstance()->m_altera_cliente_cadastrado_offline($cli_codigo, $ID_CPF_EMPRESA);
    }

    public function C_excluirCliente($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_codigo($_GET ["cli_codigo"]);
        return ClientesDao::getInstance()->M_excluirCliente($cliBean);
    }

    public function C_buscarCliente_Where($ID_CPF_EMPRESA) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ClientesDao::getInstance()->M_buscarCliente_Where($cliBean);
    }

    public function c_BuscaCliente_por_cli_chave($ID_CPF_EMPRESA, $cli_chave) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_chave($cli_chave);
        return ClientesDao::getInstance()->m_BuscaCliente_por_cli_chave($cliBean);
    }

    public function c_select_cliente_cli_chave($cli_chave) {
        return ClientesDao::getInstance()->m_select_cliente_cli_chave($cli_chave);
    }

    public function c_busca_clienteexportado_pela_chave($ID_CPF_EMPRESA, $cli_chave, $CLI_CODIGO) {
        $cliBean = new ClientesBean ();
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cliBean->setCli_chave($cli_chave);
        $cliBean->setCli_codigo($CLI_CODIGO);
        return ClientesDao::getInstance()->m_busca_clienteexportado_pela_chave($cliBean);
    }

    public function c_alterar_cliente_exportado($ID_CPF_EMPRESA) {

        // variavel codigo do cliente no java
        // params.put("codigo_do_cliente", cliente.getCli_codigo().toString());
        $cli_codigo = $_POST["codigo_do_cliente"];
        $cli_nome = str_replace("'", " ", trim($_POST["cli_nome"]));
        $cli_fantasia = str_replace("'", " ", trim($_POST["cli_fantasia"]));
        $cli_endereco = str_replace("'", " ", trim($_POST["cli_endereco"]));
        $cli_bairro = str_replace("'", " ", trim($_POST["cli_bairro"]));
        $cli_cep = str_replace("'", " ", trim($_POST["cli_cep"]));
        $cid_codigo = str_replace("'", " ", trim($_POST["cid_codigo"]));
        $cli_contato1 = str_replace("'", " ", trim($_POST["cli_contato1"]));
        $cli_contato2 = str_replace("'", " ", trim($_POST["cli_contato2"]));
        $cli_contato3 = str_replace("'", " ", trim($_POST["cli_contato3"]));
        $cli_cpfcnpj = str_replace("'", " ", trim($_POST["cli_cpfcnpj"]));
        $cli_rginscricaoest = str_replace("'", " ", trim($_POST["cli_rginscricaoest"]));
        $cli_limite = str_replace("'", " ", trim($_POST["cli_limite"]));
        $cli_email = str_replace("'", " ", trim($_POST["cli_email"]));
        $cli_observacao = str_replace("'", " ", trim($_POST["cli_observacao"]));
        $usu_codigo = str_replace("'", " ", trim($_POST["usu_codigo"]));
        $cli_senha = str_replace("'", " ", trim($_POST["cli_senha"]));
        $cli_nascimento = str_replace("'", " ", trim($_POST["cli_nascimento"]));
        $cli_chave = $_POST['cli_chave'];

        $cliBean = new ClientesBean ();

        $cliBean->setCli_codigo($cli_codigo);
        $cliBean->setCli_nascimento($cli_nascimento);
        $cliBean->setCli_nome(Util::remover_letra_acentuada($cli_nome));
        $cliBean->setCli_fantasia(Util::remover_letra_acentuada($cli_fantasia));
        $cliBean->setCli_endereco(Util::remover_letra_acentuada($cli_endereco));
        $cliBean->setCli_bairro(Util::remover_letra_acentuada($cli_bairro));
        $cliBean->setCli_cep($cli_cep);
        $cliBean->setCid_codigo($cid_codigo);
        $cliBean->setCli_contato1($cli_contato1);
        $cliBean->setCli_contato2($cli_contato2);
        $cliBean->setCli_contato3($cli_contato3);
        $cliBean->setCli_cpfcnpj($cli_cpfcnpj);
        $cliBean->setCli_rginscricaoest($cli_rginscricaoest);
        $cliBean->setCli_limite(str_replace(",", ".", $cli_limite));
        $cliBean->setCli_email(Util::remover_letra_acentuada($cli_email));
        $cliBean->setCli_observacao(Util::remover_letra_acentuada($cli_observacao));
        $cliBean->setUsu_codigo($usu_codigo);
        $cliBean->setCli_senha($cli_senha);
        $cliBean->setCli_chave($cli_chave);
        $cliBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ClientesDao::getInstance()->M_alterarClienteExportado($cliBean);
    }

}

?>
