<?php

class LogomarcasBean {

    private $ID_CPF_EMPRESA;
    private $lgm_codigo;
    private $lgm_nomelogo;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getLgm_codigo() {
        return $this->lgm_codigo;
    }

    function getLgm_nomelogo() {
        return $this->lgm_nomelogo;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setLgm_codigo($lgm_codigo) {
        $this->lgm_codigo = $lgm_codigo;
    }

    function setLgm_nomelogo($lgm_nomelogo) {
        $this->lgm_nomelogo = $lgm_nomelogo;
    }

}

?>
