<?php

class FirebaseBean {

    private $ID;
    private $ID_CPF_EMPRESA;
    private $registration_id;
    private $emp_celularkey;

    function getID() {
        return $this->ID;
    }

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getRegistration_id() {
        return $this->registration_id;
    }

    function getEmp_celularkey() {
        return $this->emp_celularkey;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setRegistration_id($registration_id) {
        $this->registration_id = $registration_id;
    }

    function setEmp_celularkey($emp_celularkey) {
        $this->emp_celularkey = $emp_celularkey;
    }

}
