<?php

require_once '../../../includes/load__class__file_path_3.php';

$cli_nome = (isset($_POST["cli_nome"])) ? $_POST["cli_nome"] : ((isset($_GET["cli_nome"])) ? $_GET["cli_nome"] : 0 );
$ID_CPF_EMPRESA = (isset($_POST["ID_CPF_EMPRESA"])) ? $_POST["ID_CPF_EMPRESA"] : ((isset($_GET["ID_CPF_EMPRESA"])) ? $_GET["ID_CPF_EMPRESA"] : 0 );

$sql = "select cli_nome from clientes where cli_nome like '%$cli_nome%' and ID_CPF_EMPRESA = '$ID_CPF_EMPRESA'";
$stm = ConPDO::getInstance()->prepare($sql);
$stm->execute();
echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
