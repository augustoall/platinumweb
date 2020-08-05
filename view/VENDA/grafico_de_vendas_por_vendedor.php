<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();

if ($visualizar == "N") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="../Assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            // Carregue o API Visualization e o pacote piechart.
            google.load('visualization', '1', {'packages': ['corechart']});

            // Defina um callback a ser executado quando o API de visualização do Google é carregado.
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                var jsonData = $.ajax({
                    url: "get_vendas_por_vendedor.php",
                    dataType: "json",
                    async: false
                }).responseText;

                // Coloque aqui as configurações do gráfico, acesse a documentação para mais opções
                var options = {'title': 'GRÁFICO DE VENDAS GERAIS - POR VENDEDOR',
                    'width': 900,
                    is3D: true,
                    'height': 680};

                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable(jsonData);

                // Instancia o gráfico com as opções definida na function drawChart() lá em cima
                // 
                // 
                // https://developers.google.com/chart/interactive/docs/gallery
                // 
                //  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

                //Desenha o gráfico
                chart.draw(data, options);
            }

        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="chart_div"></div>
                </div>                    
            </div>
        </div>

    </body>
</html>