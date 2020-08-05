<?php
ob_start();
header('Content-Type: text/html; charset=utf-8');
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("produtos");

$log = new LogInstance();

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
/* * *************************************************** */

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["prd_codigo"])) ? $_POST["prd_codigo"] : ((isset($_GET["prd_codigo"])) ? $_GET["prd_codigo"] : 0);


if ($acao != "") {
    if ($acao == "incluir") {
        $pasta = './csv/';
        $produto = $_FILES['produtoexel']['name'];
        $tmp = $_FILES['produtoexel']['tmp_name'];
        if (move_uploaded_file($tmp, $pasta . $produto)) {
            $caminho = $pasta . $produto;
            $arquivo = fopen($caminho, 'r');
            while (!feof($arquivo)) {
                $linha = fgets($arquivo, 1024);
                $dados = explode(';', $linha);
                if (!empty($linha) && $dados[0] != '') {
                    if ($linha != ";;;;;;;;") {
                        $prd = new ProdutosInstance();
                        $produto = new ProdutoBean();
                        $buscar = new ProdutoBean();
                        $produto->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
                        $codigo_de_barras = trim($dados[0]);
                        $buscar = $prd->C_buscaProdutoPorCodigoBARRAS($ID_CPF_EMPRESA, $codigo_de_barras);
                        $produto->setPrd_EAN($dados[0]);
                        $produto->setPrd_descricao($dados[1]);
                        $produto->setPrd_descr_red($dados[1]);
                        $produto->setPrd_custo($dados[2]);
                        $produto->setPrd_preco($dados[3]);
                        $produto->setPrd_unmed($dados[4]);
                        $produto->setPrd_quant($dados[5]);
                        $produto->setFor_codigo($dados[6]);
                        $produto->setCat_codigo($dados[7]);
                        $produto->setPrd_obs("via-exel");
                        $produto->setPrd_ativo("S");
                        $custo = str_replace(",", ".", $dados[2]);
                        $preco = str_replace(",", ".", $dados[3]);
                        if ($custo > 0 && $preco > 0) {
                            if (is_null($buscar->getPrd_EAN())) {
                                $prd->C_gravarProdutoVia_MS_EXEL($produto);
                                $log->c_inserir_log('PRODUTOS', 'GRAVAR-EXEL->> ' . Util::remover_letra_acentuada($produto->getPrd_descricao()) . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
                            } else {
                                $prd->C_AlteraProdutoVia_MS_EXEL($produto);
                                $log->c_inserir_log('PRODUTOS', 'ALTERAR-EXEL->> ' . Util::remover_letra_acentuada($produto->getPrd_descricao()) . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
                            }
                        }
                    }
                }
            }

            fclose($arquivo);
            header("Location:ListaProdutos.php");
        } else {
            echo "Falha ao enviar";
            exit();
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
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cadastro de Produto via Exel</h3>
                        </div>                     
                        <form role="form" name="form" id="formulario" method="post" enctype="multipart/form-data" action="CarregarProdutosExel.php">

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-body">
                                    <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                                    <input type="file" id="imagem" name="produtoexel" /> 
                                </div>


                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                </div>
                            <?php endif; ?>


                        </form>
                    </div>                      
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <img  class="img-responsive" src="../Assets/images/importar produtos csv.png"/>
                        </div>                         
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