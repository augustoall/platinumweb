<?php

class ImagensPrdBean {

    private $ID_CPF_EMPRESA;
    private $img_codigo;
    private $img_descricao;
    private $prd_codigo;
    private $prd_descricao;
    private $prd_preco;

    function getID_CPF_EMPRESA() {
        return $this->ID_CPF_EMPRESA;
    }

    function getImg_codigo() {
        return $this->img_codigo;
    }

    function getImg_descricao() {
        return $this->img_descricao;
    }

    function getPrd_codigo() {
        return $this->prd_codigo;
    }

    function setID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        $this->ID_CPF_EMPRESA = $ID_CPF_EMPRESA;
    }

    function setImg_codigo($img_codigo) {
        $this->img_codigo = $img_codigo;
    }

    function setImg_descricao($img_descricao) {
        $this->img_descricao = $img_descricao;
    }

    function setPrd_codigo($prd_codigo) {
        $this->prd_codigo = $prd_codigo;
    }
    
    function getPrd_descricao() {
        return $this->prd_descricao;
    }

    function setPrd_descricao($prd_descricao) {
        $this->prd_descricao = $prd_descricao;
    }
    function getPrd_preco() {
        return $this->prd_preco;
    }

    function setPrd_preco($prd_preco) {
        $this->prd_preco = $prd_preco;
    }





}
?>

