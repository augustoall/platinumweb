<?php

class ChaveLicencaInstance {

    public function c_grava_chave() {
        $lice = new ChaveLicencaBean();
        //$lice->setLic_chave(Util::geraChaveDeLicenca(15, true, true, true));
        $lice->setLic_chave(rand(10,9000000000));
        $lice->setLic_dias($_POST["lic_dias"]);
        $lice->setLic_usada_por("");
        $lice->setLic_datahora_uso(date('Y-m-d H:i:s'));
        $lice->setLic_status("N");
        return ChaveLicencaDao::getInstance()->m_grava_chave($lice);
    }

    public function c_atualiza_chave($lic_chave, $lic_usada_por) {
        $lice = new ChaveLicencaBean();
        $lice->setLic_chave($lic_chave);
        $lice->setLic_usada_por($lic_usada_por);
        $lice->setLic_datahora_uso(date('Y-m-d H:i:s'));
        $lice->setLic_status("S");
        return ChaveLicencaDao::getInstance()->m_atualiza_chave($lice);
    }

    public function c_busca_chave_licenca_nao_usada($lic_chave) {
        $lice = new ChaveLicencaBean();
        $lice->setLic_chave($lic_chave);
        return ChaveLicencaDao::getInstance()->m_busca_chave_licenca_nao_usada($lice);
    }

    public function c_buscar_chaves_licencas() {
        return ChaveLicencaDao::getInstance()->m_buscar_chaves_licencas();
    }
    
     public function c_buscar_chaves_licencas_nao_usadas() {
         return ChaveLicencaDao::getInstance()->m_buscar_chaves_licencas_nao_usadas();
     }

}

?>
