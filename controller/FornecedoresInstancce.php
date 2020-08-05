<?php

class FornecedoresInstancce {

    function __construct() {
        
    }

    public function C_gravarFornecedores($ID_CPF_EMPRESA) {

        $forBean = new FornecedoresBean();
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $forBean->setFor_razaosocial(Util::remover_letra_acentuada($_POST["for_razaosocial"]));
        $forBean->setFor_fantasia(Util::remover_letra_acentuada($_POST["for_fantasia"]));
        $forBean->setFor_endereco(Util::remover_letra_acentuada($_POST["for_endereco"]));
        $forBean->setFor_cep($_POST["for_cep"]);
        $forBean->setFor_bairro(Util::remover_letra_acentuada($_POST["for_bairro"]));
        $forBean->setFor_contato1($_POST["for_contato1"]);
        $forBean->setFor_contato2($_POST["for_contato2"]);
        $forBean->setFor_representante(Util::remover_letra_acentuada($_POST["for_representante"]));
        $forBean->setFor_email(Util::remover_letra_acentuada($_POST["for_email"]));
        $forBean->setFor_cnpjcpf($_POST["for_cnpjcpf"]);
        $forBean->setCid_codigo($_POST["cid_codigo"]);
        return FornecedoresDao::getInstance()->M_gravarFornecedores($forBean);
    }

    public function C_editarFornecedores($ID_CPF_EMPRESA) {
        $forBean = new FornecedoresBean();
        $forBean->setFor_codigo($_POST["for_codigo"]);
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $forBean->setFor_razaosocial(Util::remover_letra_acentuada($_POST["for_razaosocial"]));
        $forBean->setFor_fantasia(Util::remover_letra_acentuada($_POST["for_fantasia"]));
        $forBean->setFor_endereco(Util::remover_letra_acentuada($_POST["for_endereco"]));
        $forBean->setFor_cep($_POST["for_cep"]);
        $forBean->setFor_bairro(Util::remover_letra_acentuada($_POST["for_bairro"]));
        $forBean->setFor_contato1($_POST["for_contato1"]);
        $forBean->setFor_contato2($_POST["for_contato2"]);
        $forBean->setFor_representante(Util::remover_letra_acentuada($_POST["for_representante"]));
        $forBean->setFor_email(Util::remover_letra_acentuada($_POST["for_email"]));
        $forBean->setFor_cnpjcpf($_POST["for_cnpjcpf"]);
        $forBean->setCid_codigo($_POST["cid_codigo"]);
        return FornecedoresDao::getInstance()->M_editarFornecedores($forBean);
    }

    public function C_buscaTodosFornecedores($ID_CPF_EMPRESA) {
        $forBean = new FornecedoresBean();
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return FornecedoresDao::getInstance()->M_buscaTodosFornecedores($forBean);
    }

    public function C_BuscarFornecedorPorCodigo($ID_CPF_EMPRESA) {
        $forBean = new FornecedoresBean();
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $forBean->setFor_codigo($_GET["for_codigo"]);
        return FornecedoresDao::getInstance()->M_BuscarFornecedorPorCodigo($forBean);
    }

    public function C_buscarFornecedorFiltrosCombo($ID_CPF_EMPRESA) {
        $forBean = new FornecedoresBean();
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return FornecedoresDao::getInstance()->M_buscarFornecedorFiltrosCombo($forBean);
    }

    public function C_excluirFornecedor($ID_CPF_EMPRESA) {
        $forBean = new FornecedoresBean();
        $forBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $forBean->setFor_codigo($_GET["for_codigo"]);
        return FornecedoresDao::getInstance()->M_excluirFornecedor($forBean);
    }

}

?>