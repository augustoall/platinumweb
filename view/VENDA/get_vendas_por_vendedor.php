<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$table = array();
$rows = array();
$flag = true;

$table['cols'] = array(
    array('label' => 'vendedor', 'type' => 'string'),
    array('label' => 'vendas', 'type' => 'number')
);

$venda = new VendaInstance();
$vendaBean = new VendacBean();
$vendaBean = $venda->c_grafico_de_vendas_por_vendedor($_SESSION["ID_CPF_EMPRESA"]);

foreach ($vendaBean as $row) {
    $temp = array();
    $temp[] = array('v' => (string) $row['vendedor']);
    $temp[] = array('v' => (int) $row['vendas']);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
?>