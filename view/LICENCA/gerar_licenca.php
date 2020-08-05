<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$chlicencaBean = new ChaveLicencaBean();
$chave_licenca = new ChaveLicencaInstance();

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("CHAVE_DE_LICENCA");

$log = new LogInstance();

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["lic_id"])) ? $_POST["lic_id"] : ((isset($_GET["lic_id"])) ? $_GET["lic_id"] : 0);

if ($acao != "") {
    if ($acao == "incluir") {
        $chave_licenca->c_grava_chave();
        $log->c_inserir_log('LICENCA', 'GRAVAR LICENCA ' . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
    }
}


if (!$nivel == "DIRETOR") {
    echo file_get_contents('../sem-permissao-visualizar.php');
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

        <style>
            .content{
                background-color: #ecf0f5;
                min-height:5px;
                padding: 15px;
                margin-right: auto;
                margin-left: auto;
                padding-left: 15px;
                padding-right: 15px;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <section class="content">    
                <div class="row">  
                    <div class="col-md-4 col-xs-12">
                        <div class="box box-primary">
                            <form class="form-group" name="form" id="form" method="post" action="gerar_licenca.php">                       
                                <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                                <input type="hidden"  name="lic_id" id="lic_id" value="" />

                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" placeholder="Dias a serem acrescentados ao cliente"  required name="lic_dias" id="lic_dias" value="" />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Licença</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">  
                                    <table class="table table-condensed table-bordered table-hover" id="tabela">
                                        <thead style="background-color: #dddddd">
                                            <tr>
                                                <th style="width:40px">chave</th>
                                                <th style="width:10px">dias</th>
                                                <th style="width:90px" >hora da geração da chave</th>
                                                <th style="width:50px">usada por</th>
                                                <th style="width:30px">status</th>
                                            </tr>
                                        </thead>
                                        <tfoot style="background-color: #dddddd">
                                            <tr>
                                                <th style="width:40px">chave</th>
                                                <th style="width:10px">dias</th>
                                                <th style="width:90px" >hora da geração da chave</th>
                                                <th style="width:50px">usada por</th>
                                                <th style="width:30px">status</th>
                                            </tr>
                                        </tfoot> 
                                        <tbody>
                                            <?php
                                            $chlicencaBean = $chave_licenca->c_buscar_chaves_licencas();
                                            foreach ($chlicencaBean as $licenca) {
                                                ?>
                                                <tr class="gradeA odd" role="row">   
                                                    <td class="listagem_vendas"><?php echo $licenca->getLic_chave() ?></td>
                                                    <td class="listagem_vendas"><?php echo $licenca->getLic_dias() ?></td>
                                                    <td class="listagem_vendas"><?php echo $licenca->getLic_datahora_uso() ?></td>
                                                    <td class="listagem_vendas"><?php echo $licenca->getLic_usada_por() ?></td>
                                                    <td class="listagem_vendas"><?php echo ($licenca->getLic_status() == "N") ? "<span style=color:green>NAO USADA</span>" : "USADA" ?></td>
                                                </tr>
                                                <?php
                                            }
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