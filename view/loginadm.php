<?php
ob_start();
session_start();
require_once '../includes/load__class__file_path_1.php';
include_once './Config.php';

if (Util::verifica_sessao()) {


    $logo = new LogomarcasInstance();
    $empBean = new EmpresaBean ();
    $empresa = new EmpresaInstance ();
    $empresa->C_atualiza_dias_licenca();
    $permisao = new PermissoesInstance();
    $permissaoBean = new PermissoesBean();

//************************************************
    $permissaoBean = $permisao->c_buscarPermParaTabelaDe("empresa");
    $incluir = $permissaoBean->getPer_incluir();
    $alterar = $permissaoBean->getPer_alterar();
    $visualizar = $permissaoBean->getPer_visualizar();
    $excluir = $permissaoBean->getPer_excluir();
    $nivel = $permissaoBean->getPer_nivel();
    $ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
//************************************************
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Painel Admin CMDV</title>  

            <!-- tag necessaria para recarregar a pagina quando o tempo de sessao do usuario terminar  troque a ulr -->
            <meta http-equiv="refresh" content="<?php echo $_SESSION["TEMPO_DA_SESSAO"] ?>; <?php echo $_SESSION["BASE_URL"] ?> ">

            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
            <!-- Bootstrap -->
            <link href="Assets/css/bootstrap.min.css" rel="stylesheet">  
            <!-- Theme style -->
            <link rel="stylesheet" href="Assets/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="Assets/css/skin-blue.css?v=2">
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </head>
        <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
                <?php
                require_once 'header.php';
                require_once 'sidebar.php';
                ?>

                <div class="content-wrapper">  
                    <!-- conteudo -->
                    <section class="content">    
                        <div class="row">

                            <?php
                            // verificando se este login tem dias de acesso pra ser utilizado
                            $dias = $empresa->c_busca_dias_de_acesso_empresa_DATEDIFF($_SESSION["usu_celularkey"]);

                            if ($dias <= 10) {
                                ?>
                                <div class="col-md-12"> 
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Importante !!</strong> A sua licença esta expirando . você tem <?php echo $dias ?> dias de acesso.  
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="col-md-12"> 
                                <iframe name="Frame1" style="border:none"  onscroll="auto" src="home.php" width="100%" height="2000px"></iframe>
                            </div>   
                        </div>
                    </section>
                </div>            
                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 1.0
                    </div>
                    <strong>Copyright &copy;2017 <a href="http://www.centralmetadevendas.com.br">PauloCeami</a>.</strong> Todos os direitos reservados
                </footer>
            </div>
            <!--  jquery js -->
            <script src="Assets/js/jquery-3.2.1.min.js"></script>         
            <!--  bootstrap js -->
            <script src="Assets/js/bootstrap.min.js"></script>       
            <!-- Slimscroll -->
            <script src="Assets/js/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="Assets/js/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="Assets/js/app.min.js"></script>
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
        </body>
    </html>
    <?php
} else {
    header("Location:" . BASE_URL);
}
?>