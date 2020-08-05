<?php

class ClientesBean {

    private $cli_codigo;
    private $cli_nome;
    private $cli_fantasia;
    private $cli_endereco;
    private $cli_bairro;
    private $cli_cep;
    private $cid_codigo;
    private $cid_nome;
    private $cli_contato1;
    private $cli_contato2;
    private $cli_contato3;
    private $cli_nascimento;
    private $cli_cpfcnpj;
    private $cli_rginscricaoest;
    private $cli_limite;
    private $cli_email;
    private $cli_observacao;
    private $usu_codigo;
    private $usu_nome;
    private $cli_senha;
    private $cli_chave;
    private $ID_CPF_EMPRESA;
    private $offset;
    private $rows;
    private $buscar_por;
    private $valor_campo;
    //**********************************************
    //************ campos abaixo sao para nfe-sped  11 campos
    private $cli_indIEDest;
    private $cli_IE;
    private $cli_ISUF;
    private $cli_IM;
    private $cli_idEstrangeiro;
    private $cli_numero;
    private $cli_complemento;
    private $cli_nomecidade;
    private $cli_siglaestado;
    private $cli_codPais;
    private $cli_nomepais;

    function getCli_codigo() {
        return $this->cli_codigo;
    }

    function getCli_nome() {
        return $this->cli_nome;
    }

    function getCli_fantasia() {
        return $this->cli_fantasia;
    }

    function getCli_endereco() {
        return $this->cli_endereco;
    }

    function getCli_bairro() {
        return $this->cli_bairro;
    }

    function getCli_cep() {
        return $this->cli_cep;
    }

    function getCid_codigo() {
        return $this->cid_codigo;
    }

    function getCid_nome() {
        return $this->cid_nome;
    }

    function getCli_contato1() {
        return $this->cli_contato1;
    }

    function getCli_contato2() {
        return $this->cli_contato2;
    }

    function getCli_contato3() {
        return $this->cli_contato3;
    }

    function getCli_nascimento() {
        return $this->cli_nascimento;
    }

    function getCli_cpfcnpj() {
        return $this->cli_cpfcnpj;
    }

    function getCli_rginscricaoest() {
        return $this->cli_rginscricaoest;
    }

    function getCli_limite() {
        return $this->cli_limite;
    }

    function getCli_email() {
        return $this->cli_email;
    }

    function getCli_observacao() {
        return $this->cli_observacao;
    }

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getUsu_nome() {
        return $this->usu_nome;
    }

    function getCli_senha() {
        return $this->cli_senha;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getOffset() {
        return $this->offset;
    }

    function getRows() {
        return $this->rows;
    }

    function setCli_codigo($cli_codigo) {
        $this->cli_codigo = $cli_codigo;
    }

    function setCli_nome($cli_nome) {
        $this->cli_nome = $cli_nome;
    }

    function setCli_fantasia($cli_fantasia) {
        $this->cli_fantasia = $cli_fantasia;
    }

    function setCli_endereco($cli_endereco) {
        $this->cli_endereco = $cli_endereco;
    }

    function setCli_bairro($cli_bairro) {
        $this->cli_bairro = $cli_bairro;
    }

    function setCli_cep($cli_cep) {
        $this->cli_cep = $cli_cep;
    }

    function setCid_codigo($cid_codigo) {
        $this->cid_codigo = $cid_codigo;
    }

    function setCid_nome($cid_nome) {
        $this->cid_nome = $cid_nome;
    }

    function setCli_contato1($cli_contato1) {
        $this->cli_contato1 = $cli_contato1;
    }

    function setCli_contato2($cli_contato2) {
        $this->cli_contato2 = $cli_contato2;
    }

    function setCli_contato3($cli_contato3) {
        $this->cli_contato3 = $cli_contato3;
    }

    function setCli_nascimento($cli_nascimento) {
        $this->cli_nascimento = $cli_nascimento;
    }

    function setCli_cpfcnpj($cli_cpfcnpj) {
        $this->cli_cpfcnpj = $cli_cpfcnpj;
    }

    function setCli_rginscricaoest($cli_rginscricaoest) {
        $this->cli_rginscricaoest = $cli_rginscricaoest;
    }

    function setCli_limite($cli_limite) {
        $this->cli_limite = $cli_limite;
    }

    function setCli_email($cli_email) {
        $this->cli_email = $cli_email;
    }

    function setCli_observacao($cli_observacao) {
        $this->cli_observacao = $cli_observacao;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setUsu_nome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    function setCli_senha($cli_senha) {
        $this->cli_senha = $cli_senha;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setOffset($offset) {
        $this->offset = $offset;
    }

    function setRows($rows) {
        $this->rows = $rows;
    }

    function getCli_chave() {
        return $this->cli_chave;
    }

    function setCli_chave($cli_chave) {
        $this->cli_chave = $cli_chave;
    }

    function getBuscar_por() {
        return $this->buscar_por;
    }

    function getValor_campo() {
        return $this->valor_campo;
    }

    function setBuscar_por($buscar_por) {
        $this->buscar_por = $buscar_por;
    }

    function setValor_campo($valor_campo) {
        $this->valor_campo = $valor_campo;
    }

    //**********************************************
    //************ campos abaixo sao para nfe-sped  11 campos getters and setters
    function getCli_indIEDest() {
        return $this->cli_indIEDest;
    }

    function getCli_IE() {
        return $this->cli_IE;
    }

    function getCli_ISUF() {
        return $this->cli_ISUF;
    }

    function getCli_IM() {
        return $this->cli_IM;
    }

    function getCli_idEstrangeiro() {
        return $this->cli_idEstrangeiro;
    }

    function getCli_numero() {
        return $this->cli_numero;
    }

    function getCli_complemento() {
        return $this->cli_complemento;
    }

    function getCli_nomecidade() {
        return $this->cli_nomecidade;
    }

    function getCli_siglaestado() {
        return $this->cli_siglaestado;
    }

    function getCli_codPais() {
        return $this->cli_codPais;
    }

    function getCli_nomepais() {
        return $this->cli_nomepais;
    }

    function setCli_indIEDest($cli_indIEDest) {
        $this->cli_indIEDest = $cli_indIEDest;
    }

    function setCli_IE($cli_IE) {
        $this->cli_IE = $cli_IE;
    }

    function setCli_ISUF($cli_ISUF) {
        $this->cli_ISUF = $cli_ISUF;
    }

    function setCli_IM($cli_IM) {
        $this->cli_IM = $cli_IM;
    }

    function setCli_idEstrangeiro($cli_idEstrangeiro) {
        $this->cli_idEstrangeiro = $cli_idEstrangeiro;
    }

    function setCli_numero($cli_numero) {
        $this->cli_numero = $cli_numero;
    }

    function setCli_complemento($cli_complemento) {
        $this->cli_complemento = $cli_complemento;
    }

    function setCli_nomecidade($cli_nomecidade) {
        $this->cli_nomecidade = $cli_nomecidade;
    }

    function setCli_siglaestado($cli_siglaestado) {
        $this->cli_siglaestado = $cli_siglaestado;
    }

    function setCli_codPais($cli_codPais) {
        $this->cli_codPais = $cli_codPais;
    }

    function setCli_nomepais($cli_nomepais) {
        $this->cli_nomepais = $cli_nomepais;
    }

}

?>
