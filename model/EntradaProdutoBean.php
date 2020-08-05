<?php

class EntradaProdutoBean {

    private $ID_CPF_EMPRESA;
    private $ent_id;
    private $ent_numeronota;
    private $ent_data_entrada;
    private $ent_valor_nota;
    private $usu_codigo;
    private $for_codigo;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getEnt_id() {
        return $this->ent_id;
    }

    function getEnt_numeronota() {
        return $this->ent_numeronota;
    }

    function getEnt_data_entrada() {
        return $this->ent_data_entrada;
    }

    function getEnt_valor_nota() {
        return $this->ent_valor_nota;
    }

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getFor_codigo() {
        return $this->for_codigo;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setEnt_id($ent_id) {
        $this->ent_id = $ent_id;
    }

    function setEnt_numeronota($ent_numeronota) {
        $this->ent_numeronota = $ent_numeronota;
    }

    function setEnt_data_entrada($ent_data_entrada) {
        $this->ent_data_entrada = $ent_data_entrada;
    }

    function setEnt_valor_nota($ent_valor_nota) {
        $this->ent_valor_nota = $ent_valor_nota;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setFor_codigo($for_codigo) {
        $this->for_codigo = $for_codigo;
    }

}
