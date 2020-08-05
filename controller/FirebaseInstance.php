<?php

class FirebaseInstance {

    function __construct() {
        
    }

    public function c_save_device_firebase($ID_CPF_EMPRESA, $emp_celularkey, $registration_id) {
        $fireBean = new FirebaseBean();
        $fireBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $fireBean->setEmp_celularkey($emp_celularkey);
        $fireBean->setRegistration_id($registration_id);
        return FirebaseDAO::getInstance()->m_save_device_firebase($fireBean);
    }

    public function c_delete_device_firebase($emp_celularkey) {
        return FirebaseDAO::getInstance()->m_delete_device_firebase($emp_celularkey);
    }

    public function c_getAllDevices() {
        return FirebaseDAO::getInstance()->m_getAllDevices();
    }

    public function c_atualiza_ID_CPF_EMPRESA_firebase($ID_CPF_EMPRESA, $emp_celularkey) {
        $fireBean = new FirebaseBean();
        $fireBean->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $fireBean->setEmp_celularkey($emp_celularkey);
        return FirebaseDAO::getInstance()->m_atualiza_ID_CPF_EMPRESA_firebase($fireBean);
    }

}
