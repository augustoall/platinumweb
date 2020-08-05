<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
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
        <section class="content">    
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        
                        
                        <div class="box-header with-border">
                            <h3 class="box-title">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</h3>
                        </div> 
                        
                        
                        <form role="form" action="CadastraCategorias.php" method="post" id="form_categoria">                       


                            <div class="box-body">

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">

                                    </div>
                                </div>


                            </div> 

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar</button>
                                </div>
                            <?php endif; ?>


                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>  
                </div>
            </div>

        </section>
        <!--  jquery js -->
        <script src="../Assets/js/jquery-3.2.1.min.js"></script>         
        <!--  bootstrap js -->
        <script src="../Assets/js/bootstrap.min.js"></script> 
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  
    </body>
</html>