<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}
$categoria = new CategoriasInstance();
$categoriaBean = new CategoriasBean();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("categorias");
$log = new LogInstance();
$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["cat_codigo"])) ? $_POST["cat_codigo"] : ((isset($_GET["cat_codigo"])) ? $_GET["cat_codigo"] : 0);
$retorno = (isset($_POST["retorno"])) ? $_POST["retorno"] : ((isset($_GET["retorno"])) ? $_GET["retorno"] : "");
if ($codigo > 0) {
    $categoriaBean = $categoria->C_buscaCategoriasPorCodigo($ID_CPF_EMPRESA);
}
if ($acao != "") {
    if ($acao == "incluir") {
        $categoria->c_gravarCategorias($ID_CPF_EMPRESA);
        $log->c_inserir_log('CATEGORIAS', 'GRAVAR->> ' . $_POST["cat_descricao"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
        if ($retorno == "produtos") {
            header("Location:../PRODUTOS/CadastraProdutos.php");
        } else {
            header("Location:ListaCategorias.php");
        }
    } elseif ($acao == "alterar") {
        if ($categoria->c_alterarCategorias($ID_CPF_EMPRESA)) {
            $log->c_inserir_log('CATEGORIAS', 'ALTERAR->> ' . $_POST["cat_descricao"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaCategorias.php");
        }
    } elseif ($acao == "excluir") {
        if ($categoria->c_excluirCategorias($ID_CPF_EMPRESA)) {
            $log->c_inserir_log('CATEGORIAS', 'EXCLUIR->> ' . $_GET["cat_codigo"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaCategorias.php");
        }
    }
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
                <div class="col-md-6 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cadastro de Categorias</h3>
                        </div>                     
                        <form role="form" action="CadastraCategorias.php" method="post" id="form_categoria">

                            <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                            <input type="hidden"  name="cat_codigo" id="cat_codigo" value="<?php echo $categoriaBean->getCat_codigo() ?>" />
                            <input type="hidden"  name="retorno" id="retorno" value="<?php echo $retorno ?>" />

                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label" data-toggle="tooltip" data-placement="right" title="codigo nao pode ser informado" for="inputSuccess1">Código</label>                          
                                    <input class="form-control input-sm" type="text" disabled name="CO" id="CO" value="<?php echo $categoriaBean->getCat_codigo() ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label"  for="inputWarning1">Nome da Categoria</label>
                                    <input class="form-control input-sm" required type="text" data-toggle="tooltip" data-placement="bottom" title="nome da categoria" placeholder="Descrição" required name="cat_descricao" id="cat_descricao" value="<?php echo $categoriaBean->getCat_descricao() ?>" />
                                </div>
                            </div>  

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar Categoria</button>
                                </div>
                            <?php endif; ?>


                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Categoria</button>
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