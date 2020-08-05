<?php

class ChequesInstance {

    function __construct() {
        
    }

    public function c_busca_cheque_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave) {
        $cheque = new ChequesBean();
        $cheque->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $cheque->setVendac_chave($vendac_chave);
        return ChequesDao::getInstance()->m_busca_cheque_por_vendac_chave($cheque);
    }

    public function c_busca_todos_cheques($ID_CPF_EMPRESA) {
        $cheque = new ChequesBean();
        $cheque->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ChequesDao::getInstance()->m_busca_todos_cheques($cheque);
    }

    public function c_inserir_cheque_exportado() {
        $cheque = new ChequesBean();
        $cheque->setID_CPF_EMPRESA($_POST["ID_CPF_EMPRESA"]);
        $cheque->setChq_cli_codigo($_POST["chq_cli_codigo"]);
        $cheque->setChq_numerocheque($_POST["chq_numerocheque"]);
        $cheque->setChq_telefone1($_POST["chq_telefone1"]);
        $cheque->setChq_telefone2($_POST["chq_telefone2"]);
        $cheque->setChq_cpf_dono($_POST["chq_cpf_dono"]);
        $cheque->setChq_nomedono(Util::remover_letra_acentuada($_POST["chq_nomedono"]));
        $cheque->setChq_nomebanco($_POST["chq_nomebanco"]);
        $cheque->setChq_vencimento($_POST["chq_vencimento"]);
        $cheque->setChq_valorcheque($_POST["chq_valorcheque"]);
        $cheque->setChq_terceiro($_POST["chq_terceiro"]);
        $cheque->setVendac_chave($_POST["vendac_chave"]);
        $cheque->setChq_enviado("N");
        $cheque->setChq_dataCadastro($_POST["chq_dataCadastro"]);
        return ChequesDao::getInstance()->m_inserir_cheque_exportado($cheque);
    }

    public function c_atualiza_codigo_cliente_offline_cheque($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo) {
        return ChequesDao::getInstance()->m_atualiza_codigo_cliente_offline_cheque($ID_CPF_EMPRESA, $codigo_novo, $codigo_antigo);
    }

}
?>

