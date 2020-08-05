<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("empresa");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

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
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <section class="content">    
                <div class="row">      

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">                                   
                                    <a class="btn btn-mini btn-primary" title="gerar licença"  href="../LICENCA/gerar_licenca.php"><i class="fa fa-key"></i> 
                                        Gerar Licenças</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">  
                                    <table class="table table-condensed table-bordered table-hover" id="tabela">
                                        <thead style="background-color: #dddddd">
                                            <tr>
                                                <th>NOME DA EMPRESA</th>
                                                <th>ID CPF EMPRESA</th>
                                                <th>CELULAR</th>
                                                <th>INICIO LICENÇA</th>
                                                <th>FIM LICENÇA</th>
                                                <th>SERIAL KEY</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tfoot style="background-color: #dddddd">
                                            <tr>
                                                <th>NOME DA EMPRESA</th>
                                                <th>ID CPF EMPRESA</th>
                                                <th>CELULAR</th>
                                                <th>INICIO LICENÇA</th>
                                                <th>FIM LICENÇA</th>
                                                <th>SERIAL KEY</th>
                                                <th>Ações</th>
                                            </tr>
                                        </tfoot> 
                                        <tbody>
                                            <?php
                                            $empresa = new EmpresaInstance();
                                            $empBean = new EmpresaBean();
                                            $emp = $empresa->c_bsuca_todas_empresas_para_administracao();
                                            foreach ($emp as $empBean) {
                                                ?>
                                                <tr class="gradeA odd" role="row">
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_nome() ?></td>
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_cpf() ?></td>  
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_numerocelular() ?></td>  
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_inicio() ?></td> 
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_fim() ?></td>  
                                                    <td class="listagem_vendas"><?php echo $empBean->getEmp_celularkey() ?></td>  
                                                    <td>
                                                        <div class="btn-group">                                                              
                                                            <a class="btn btn-mini btn-info"  title="Editar" href="AdministraEmpresa.php?emp_codigo=<?php echo $empBean->getEmp_codigo() ?>&emp_celularkey=<?php echo $empBean->getEmp_celularkey() ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                        </div>
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
