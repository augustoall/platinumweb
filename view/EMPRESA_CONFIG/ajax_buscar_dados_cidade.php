<?php
require_once '../../includes/load__class__file_path_2.php';
$emp_cod_municipio = isset($_GET["emp_cod_municipio"]) ? $_GET["emp_cod_municipio"] : 0;
$cidade = new CidadesInstace();
$cid = $cidade->c_busca_cidade_por_codigo_ibge(trim($emp_cod_municipio));
echo $cid;
?>

