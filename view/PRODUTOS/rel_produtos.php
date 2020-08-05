<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("produtos");
$cateBean = new CategoriasBean();
$categoria = new CategoriasInstance();

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
        <!-- style select -->
        <link rel="stylesheet" href="../Assets/css/select2.min.css"> 
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
                            <h3 class="box-title">Imprimir relatórios de Produtos</h3>
                        </div>                     
                        <form role="form" action="imprimir_rel_prod.php" method="post" id="form_rel_produto">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <label class="control-label" for="inputSuccess1"> Categoria</label>
                                    <select   class="form-control select2"  name="produto"  >
                                        <option value="" >[Selecione...]</option>                                        
                                        <?php
                                        $cateBean = new CategoriasBean();
                                        $categoria = new CategoriasInstance();
                                        $cateBean = $categoria->c_buscaTodasCategorias($ID_CPF_EMPRESA);
                                        foreach ($cateBean as $cat) {
                                            ?>
                                            <option value="<?php echo $cat->getCat_codigo() ?>"><?php echo $cat->getCat_descricao() ?></option>
                                        <?php } ?>
                                    </select>
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
        <script src="../Assets/js/jquery-3.2.1.min.js"></script>         
        <!--  bootstrap js -->
        <script src="../Assets/js/bootstrap.min.js"></script> 
        <!-- select2 -->
        <script src="../Assets/js/select2.full.min.js"></script>
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  
        <script type="text/javascript">
            $(function () {
                $(".select2").select2();
            });
        </script>
    </body>
</html>