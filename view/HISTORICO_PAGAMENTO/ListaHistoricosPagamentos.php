<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("historico_pagamento");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

if ($visualizar == 'N') {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

$historicoPgto = new HistoricoPgtoInstance();
$histBean = new HistoricoPgtoBean();

if ($nivel == "ADM") {
    $histBean = $historicoPgto->c_buscar_historicos_adm($ID_CPF_EMPRESA);
}

if ($nivel == "USER") {
    $histBean = $historicoPgto->c_buscar_apenas_historicos_vendedor($ID_CPF_EMPRESA, $_SESSION["usu_celularkey"]);
}

if ($nivel == "DIRETOR") {
    $histBean = $historicoPgto->c_buscar_historicos_diretor();
}

if (count($histBean) <= 0) {
    echo file_get_contents('../nenhum-registro-encontrado.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Painel Admin CMDV</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Bootstrap -->
        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">    
        <!-- css datatable -->
        <link href="../Assets/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../Assets/css/dataTables.responsive.css" rel="stylesheet">
        <!-- Theme style -->
        <link rel="stylesheet" href="../Assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../Assets/css/skin-blue.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <section class="content">    
                <div class="row">




                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">  
                                    <table class="table table-condensed table-bordered table-hover" id="tabela">
                                        <thead style="background-color: #dddddd">
                                            <tr>  
                                                <th>Cliente</th>
                                                <th>Venda</th>
                                                <th>Pagamento</th>
                                                <th>Parcela</th>
                                                <th>Valor da Parcela</th>
                                                <th>Valor Pago no dia</th>
                                                <th>Restante</th>

                                                <th>Como Pagou</th>  
                                            </tr>
                                        </thead>
                                        <tfoot style="background-color: #dddddd">
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Venda</th>
                                                <th>Pagamento</th>
                                                <th>Parcela</th>
                                                <th>Valor da Parcela</th>
                                                <th>Valor Pago no dia</th>
                                                <th>Restante</th>

                                                <th>Como Pagou</th> 
                                            </tr>
                                        </tfoot> 
                                        <tbody>
                                            <?php
                                            foreach ($histBean as $hist) :
                                                ?>
                                                <tr class="gradeA odd" role="row">
                                                    <td class="listagem_vendas"><?php echo strtoupper($hist->getHist_nomecliente()) ?></td>
                                                    <td class="listagem_vendas"><?php echo $hist->getVendac_chave() ?></td>
                                                    <td class="listagem_vendas"><?php echo Util::format_DD_MM_AAAA($hist->getHist_datapagamento()) ?></td>
                                                    <td class="listagem_vendas"><?php echo $hist->getHist_numero_parcela() ?></td>
                                                    <td class="listagem_vendas"><?php echo $hist->getHist_valor_real_parcela() ?> </td>
                                                    <td class="listagem_vendas"><?php echo $hist->getHist_valor_pago_no_dia() ?></td>                       
                                                    <td class="listagem_vendas"><?php echo $hist->getHist_restante_a_pagar() ?></td>                                  

                                                    <td class="listagem_vendas"><?php echo $hist->getHist_pagou_com() ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
        <!--  jquery js -->
        <script src="../Assets/js/jquery-3.2.1.min.js"></script>         
        <!--  bootstrap js -->
        <script src="../Assets/js/bootstrap.min.js"></script> 
        <!-- datatable bootstrap -->
        <script src="../Assets/js/jquery.dataTables.min.js"></script>      
        <script src="../Assets/js/dataTables.bootstrap.min.js"></script>
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#tabela').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>
