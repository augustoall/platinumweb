<?php
require_once '../../includes/load__class__file_path_2.php';
$cid_uf = isset($_GET["cid_uf"]) ? $_GET["cid_uf"] : 0;
$cidade = new CidadesInstace();
$cid = $cidade->c_busca_todas_cidades_combobox(trim($cid_uf));
echo $cid;
?>