<?php

class ChaveLicencaBean {

    private $lic_id;
    private $lic_chave;
    private $lic_dias;
    private $lic_usada_por;
    private $lic_datahora_uso;
    private $lic_status;

    function getLic_id() {
        return $this->lic_id;
    }

    function getLic_chave() {
        return $this->lic_chave;
    }

    function getLic_dias() {
        return $this->lic_dias;
    }

    function getLic_usada_por() {
        return $this->lic_usada_por;
    }

    function getLic_datahora_uso() {
        return $this->lic_datahora_uso;
    }

    function getLic_status() {
        return $this->lic_status;
    }

    function setLic_id($lic_id) {
        $this->lic_id = $lic_id;
    }

    function setLic_chave($lic_chave) {
        $this->lic_chave = $lic_chave;
    }

    function setLic_dias($lic_dias) {
        $this->lic_dias = $lic_dias;
    }

    function setLic_usada_por($lic_usada_por) {
        $this->lic_usada_por = $lic_usada_por;
    }

    function setLic_datahora_uso($lic_datahora_uso) {
        $this->lic_datahora_uso = $lic_datahora_uso;
    }

    function setLic_status($lic_status) {
        $this->lic_status = $lic_status;
    }

}
?>


