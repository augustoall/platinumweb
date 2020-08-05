<?php

require_once '../../../includes/load__class__file_path_3.php';
$usu_nome = (isset($_POST["usu_nome"])) ? $_POST["usu_nome"] : ((isset($_GET["usu_nome"])) ? $_GET["usu_nome"] : 0 );
$ID_CPF_EMPRESA = (isset($_POST["ID_CPF_EMPRESA"])) ? $_POST["ID_CPF_EMPRESA"] : ((isset($_GET["ID_CPF_EMPRESA"])) ? $_GET["ID_CPF_EMPRESA"] : 0 );
$sql = "select usu_nome from usuarios where usu_nome like '%$usu_nome%' and ID_CPF_EMPRESA = '$ID_CPF_EMPRESA'";
$stm = ConPDO::getInstance()->prepare($sql);
$stm->execute();
echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
