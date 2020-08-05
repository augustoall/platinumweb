<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$connection=mysqli_connect ('apcmdvvenda.mysql.dbaas.com.br', 'apcmdvvenda', 'ssspmg221242ap');
if (!$connection) {  die('nao foi possivel conectar' . mysql_error());}

$db_selected = mysqli_select_db($connection,'apcmdvvenda');
if (!$db_selected) {
  die ('database erro : ' . mysql_error());
}

$query = "select 
venda.vendac_cli_nome,
venda.vendac_latitude,
venda.vendac_longitude,
cli.cli_endereco
from vendac venda
left outer join clientes cli 
on cli.cli_codigo = venda.vendac_cli_codigo";
$result = mysqli_query($connection,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
header("Content-type: text/xml");


while ($row = mysqli_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['vendac_cli_nome']);
  $newnode->setAttribute("lat",$row['vendac_latitude']);
  $newnode->setAttribute("lng",$row['vendac_longitude']);
  $newnode->setAttribute("address",$row['cli_endereco']);
}
echo $dom->saveXML();

?>
