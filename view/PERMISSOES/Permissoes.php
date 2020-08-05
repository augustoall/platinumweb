<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$log = new LogInstance();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->c_buscarPermParaTabelaDe("permissoes");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$usu_celularkey = (isset($_POST["usu_celularkey"])) ? $_POST["usu_celularkey"] : ((isset($_GET["usu_celularkey"])) ? $_GET["usu_celularkey"] : 0);
$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");


if ($nivel == "USER") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

if ($acao == "1") {
    $permisao->c_atualizarPermisssoes_GET();
    $log->c_inserir_log('PERMISSOES', 'ALTERAR PERMISSAO PARA->> ' . $_GET["log_numerocelular"] . '  / TABELA->> ' . $_GET["nome_tabela"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
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
                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">  
                                    <table class="table table-condensed table-bordered table-hover" id="tabela">
                                        <thead style="background-color: #dddddd">
                                            <tr>
                                                <th>Tabela</th>
                                                <th>Cadastrar</th>
                                                <th>Alterar</th>
                                                <th>Visualizar</th>
                                                <th>Excluir</th> 
                                            </tr>
                                        </thead>
                                        <tfoot style="background-color: #dddddd">
                                            <tr>
                                                <th>Tabela</th>
                                                <th>Cadastrar</th>
                                                <th>Alterar</th>
                                                <th>Visualizar</th>
                                                <th>Excluir</th> 
                                            </tr>
                                        </tfoot> 
                                        <tbody>
                                            <?php
                                            $perm = new PermissoesInstance();
                                            $permissao = new PermissoesBean();
                                            $permissao = $perm->c_busca_permissoes_do_usuario_selecionado($usu_celularkey, $ID_CPF_EMPRESA);


                                            foreach ($permissao as $permissao_usuario) {

                                                $inc = '&per_incluir=' . $permissao_usuario->getPer_incluir();
                                                $alt = '&per_alterar=' . $permissao_usuario->getPer_alterar();
                                                $vis = '&per_visualizar=' . $permissao_usuario->getPer_visualizar();
                                                $exc = '&per_excluir=' . $permissao_usuario->getPer_excluir();
                                                $tabela = '&nome_tabela=' . $permissao_usuario->getNome_tabela();
                                                $celkey = '&usu_celularkey=' . $permissao_usuario->getUsu_celularkey();
                                                $acao = '&acao=1';

                                                $option_invisible = array('LOG', 'HISTORICO_PAGAMENTO', 'CHEQUES', 'VENDAC', 'RECEBER');
                                                ?>
                                                <tr class="odd gradeA">

                                                    <td><?php echo $permissao_usuario->getNome_tabela() ?></td>

                                                    <!-- ****************  INCLUIR **************** -->
                                                    <!-- ****************  INCLUIR **************** -->
                                                    <td align="center">
                                                        <?php if (in_array($permissao_usuario->getNome_tabela(), $option_invisible)) { ?>  
                                                            <i class="fa fa-exclamation-triangle fa-2x" style="color:gray" aria-hidden="true"></i>

                                                        <?php } else { ?>  

                                                            <?php if ($permissao_usuario->getPer_incluir() == "S"): ?>                                
                                                                <a href="Permissoes.php?per_incluir=N<?php echo $alt . $vis . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_incluir() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'   ></i>" ?></a>                             
                                                            <?php endif; ?>

                                                            <?php if ($permissao_usuario->getPer_incluir() == "N"): ?>  
                                                                <a href="Permissoes.php?per_incluir=S<?php echo $alt . $vis . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_incluir() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green' ></i>" : "<i class='fa fa-times fa-2x' style='color:red'  ></i>" ?></a>
                                                            <?php endif; ?>
                                                        <?php } ?>  
                                                    </td>

                                                    <!-- ****************  ALTERAR **************** -->
                                                    <!-- ****************  ALTERAR **************** -->
                                                    <td align="center">
                                                        <?php if (in_array($permissao_usuario->getNome_tabela(), $option_invisible)) { ?>  
                                                            <i class="fa fa-exclamation-triangle fa-2x" style="color:gray" aria-hidden="true"></i>                          
                                                        <?php } else { ?> 

                                                            <?php if ($permissao_usuario->getPer_alterar() == "S"): ?>                                
                                                                <a href="Permissoes.php?per_alterar=N<?php echo $inc . $vis . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_alterar() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                            <?php endif; ?>

                                                            <?php if ($permissao_usuario->getPer_alterar() == "N"): ?>  
                                                                <a href="Permissoes.php?per_alterar=S<?php echo $inc . $vis . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_alterar() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                            <?php endif; ?>

                                                        <?php } ?> 
                                                    </td>


                                                    <!-- ****************  VISUALIZAR **************** -->
                                                    <!-- ****************  VISUALIZAR **************** -->
                                                    <td align="center">
                                                        <?php if ($permissao_usuario->getPer_visualizar() == "S"): ?>                                
                                                            <a href="Permissoes.php?per_visualizar=N<?php echo $alt . $inc . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_visualizar() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                        <?php endif; ?>

                                                        <?php if ($permissao_usuario->getPer_visualizar() == "N"): ?>  
                                                            <a href="Permissoes.php?per_visualizar=S<?php echo $alt . $inc . $exc . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_visualizar() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                        <?php endif; ?>
                                                    </td>


                                                    <!-- ****************  EXCLUIR **************** -->
                                                    <!-- ****************  EXCLUIR **************** -->
                                                    <td align="center">
                                                        <?php if (in_array($permissao_usuario->getNome_tabela(), $option_invisible)) { ?>  
                                                            <i class="fa fa-exclamation-triangle fa-2x" style="color:gray" aria-hidden="true"></i>                          
                                                        <?php } else { ?> 

                                                            <?php if ($permissao_usuario->getPer_excluir() == "S"): ?>                                
                                                                <a href="Permissoes.php?per_excluir=N<?php echo $alt . $inc . $vis . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_excluir() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                            <?php endif; ?>

                                                            <?php if ($permissao_usuario->getPer_excluir() == "N"): ?>  
                                                                <a href="Permissoes.php?per_excluir=S<?php echo $alt . $inc . $vis . $celkey . $tabela . $acao ?>" ><?php echo ($permissao_usuario->getPer_excluir() == "S") ? "<i class='fa fa-check-square-o fa-2x' style='color:green'></i>" : "<i class='fa fa-times fa-2x' style='color:red'></i>" ?></a>                             
                                                            <?php endif; ?>

                                                        <?php } ?> 
                                                    </td>
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


