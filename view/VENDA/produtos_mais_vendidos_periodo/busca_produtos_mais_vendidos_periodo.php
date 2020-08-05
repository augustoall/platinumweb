<?php
ob_start();
require_once '../../../includes/load__class__file_path_3.php';
if (!Util::verifica_sessao()) {
    header("location:../../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();
if ($visualizar == "N") {
    echo file_get_contents('../../sem-permissao-visualizar.php');
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
        <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- style select -->
        <link rel="stylesheet" href="../../Assets/css/select2.min.css"> 
        <!-- iCheck polaris -->
        <link href="../../Assets/css/polaris/polaris.css" rel="stylesheet">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../Assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../../Assets/css/skin-blue.css">
        <!-- custom bootstrap css -->
        <link rel="stylesheet" href="../../Assets/css/bootstrap-custom.css?v2">
        <!-- datepicker css -->
        <link rel="stylesheet" href="../../Assets/css/bootstrap-datepicker.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>    
    <body class="hold-transition skin-blue sidebar-mini">
        <section class="content">    
            <div class="row">
               <?php
                $cliente = new ClientesInstance();
                $c_busca_cliente = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
                if (count($c_busca_cliente) > 0) {
                    ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">                                   
                                    <a class="btn btn-danger  btn-sm" title="info"  href="../../CLIENTES/UpdateClienteCadastradoOFFLINE.php?ID_CPF_EMPRESA=<?php echo $ID_CPF_EMPRESA ?>" target="Frame1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ATENÇÃO ATUALIZE CLIENTES QUE FORAM CADASTRADOS OFF LINE NO CELULAR ANDROID</a>
                                </div>
                            </div>
                        </div>
                    </div>                   

                <?php } ?>
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Imprimir vendas por produtos mais vendidos </h3>
                        </div> 
                        <form role="form" class="form-group" name="form"  method="post"  autocomplete="off" action="relatorio_produtos_mais_vendidos.php">
                            <input type="hidden" name="ID_CPF_EMPRESA" id="ID_CPF_EMPRESA" value="<?php echo $_SESSION["ID_CPF_EMPRESA"] ?>"/>
                            <div class="box-body">
                                <div class="col-sm-6"> 
                                    <div class="form-group">                       
                                        <label class="control-label">Data inicial</label>
                                        <input required id="data_inicial"   name="data_inicial"     type="text" class="form-control" placeholder="data inicial">
                                    </div>
                                </div> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">                       
                                        <label class="control-label">Data final</label>
                                        <input required id="data_final"  name="data_final" type="text" class="form-control" placeholder="data final">
                                    </div> 
                                </div> 

                            </div>
                            <div class="box-footer"> 
                                <button type="submit" class="btn btn-default btn-block"><i class="fa fa-print" aria-hidden="true"></i> imprimir</button>
                            </div>
                        </form>
                    </div> 
                </div>  
            </div>

        </section>
        <!--  jquery js -->
        <script src="../../Assets/js/jquery-3.2.1.min.js"></script>         
        <!--  bootstrap js -->
        <script src="../../Assets/js/bootstrap.min.js"></script> 
        <!-- select2 -->
        <script src="../../Assets/js/select2.full.min.js"></script>
        <!-- Slimscroll -->
        <script src="../../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../../Assets/js/fastclick.js"></script>
        <!-- iCheck -->
        <script src="../../Assets/js/icheck.min.js"></script>
        <!-- datepickers -->
        <script src="../../Assets/js/bootstrap-datepicker.min.js"></script>
        <script src="../../Assets/js/bootstrap-datepicker.pt-BR.min.js"></script>
        <!-- autocomplete -->
        <script src="auto_complete_cliente.js?v2"></script>
        <!-- AdminLTE App -->
        <script src="../../Assets/js/app.min.js"></script>  


        <script>
            $(document).ready(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_polaris'
                });

                $(".select2").select2();

                $('#data_inicial').datepicker({
                    format: "dd/mm/yyyy",
                    language: "pt-BR",
                    orientation: "top left",
                    autoclose: true,
                    todayHighlight: true
                });

                $('#data_final').datepicker({
                    format: "dd/mm/yyyy",
                    language: "pt-BR",
                    orientation: "top left",
                    autoclose: true,
                    todayHighlight: true
                });
            });
        </script>

    </body>
</html>
