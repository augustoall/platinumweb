<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$usuBean = new UsuariosBean();
$usuario = new UsuariosInstance();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("usuarios");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

if ($visualizar == "N") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

if ($nivel == "DIRETOR") {
    $usuBean = $usuario->c_listar_todos_usuarios_para_diretor();
}

if ($nivel == "ADM") {
    $usuBean = $usuario->c_buscarUsuariosLiberados($ID_CPF_EMPRESA, "S");
}

if ($nivel == "USER") {
    $usuBean = $usuario->c_BuscarUsuarioPorCodigo($ID_CPF_EMPRESA, $_SESSION["usu_codigo"]);
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
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Celular</th>
                                                <th>Ações</th>                           
                                            </tr>
                                        </thead>
                                        <tfoot style="background-color: #dddddd">
                                            <tr>
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Celular</th>
                                                <th>Ações</th> 
                                            </tr>
                                        </tfoot> 
                                        <tbody>
                                            <?php
                                            // se for usuario vê apenas os dados dele
                                            if ($nivel == "USER") { ?>
                                                
                                               <tr class="gradeA odd" role="row">
                                                        <td class="listagem_vendas"><?php echo $usuBean->getUsu_codigo() ?></td>
                                                        <td class="listagem_vendas"><?php echo $usuBean->getUsu_nome() ?></td>  
                                                        <td class="listagem_vendas"><?php echo $usuBean->getUsu_email() ?></td>  
                                                        <td class="listagem_vendas"><?php echo $usuBean->getUsu_numerocelular() ?></td>  
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php if ($alterar == "S") { ?>
                                                                    <a class="btn btn-mini btn-warning btn-xs"  title="Editar" href="CadastraUsuarios.php?usu_codigo=<?php echo $usuBean->getUsu_codigo() ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                        Editar</a>
                                                                <?php } ?>

                                                                <a class="btn btn-mini btn-default btn-xs" title="Excluir"  href=""><i class="fa fa-trash" aria-hidden="true"></i> Excluir</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                          <?php }else{
                                                foreach ($usuBean as $usu) {
                                                    ?>
                                                    <tr class="gradeA odd" role="row">
                                                        <td class="listagem_vendas"><?php echo $usu->getUsu_codigo() ?></td>
                                                        <td class="listagem_vendas"><?php echo $usu->getUsu_nome() ?></td>  
                                                        <td class="listagem_vendas"><?php echo $usu->getUsu_email() ?></td>  
                                                        <td class="listagem_vendas"><?php echo $usu->getUsu_numerocelular() ?></td>  
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php if ($alterar == "S") { ?>
                                                                    <a class="btn btn-mini btn-warning btn-xs"  title="Editar" href="CadastraUsuarios.php?usu_codigo=<?php echo $usu->getUsu_codigo() ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                        Editar</a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
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
