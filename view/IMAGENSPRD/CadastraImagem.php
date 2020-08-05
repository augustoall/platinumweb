<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

include_once("../Assets/libs/wideimage/WideImage.php");

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("produtos");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$img = new ImagensPrdInstance();
$imagemBean = new ImagensPrdBean();

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");

$prd_codigo = (isset($_POST["prd_codigo"])) ? $_POST["prd_codigo"] : ((isset($_GET["prd_codigo"])) ? $_GET["prd_codigo"] : 0);
$descricaoproduto = (isset($_POST["descricaoproduto"])) ? $_POST["descricaoproduto"] : ((isset($_GET["descricaoproduto"])) ? $_GET["descricaoproduto"] : 0);

if ($acao != "") {
    if ($acao == "incluir") {

        require_once "../Assets/libs/wideimage/WideImage.php";
        
        $_UP['path_img'] = 'http://www.centralmetadevendas.com.br/SistemaCMDV/view/Assets/produtosimg/';
        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = '../Assets/produtosimg/';
// Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
// Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'jpeg', 'png');
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = false;
// Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
            exit; // Para a execução do script
        }
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
        // $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
        $up = explode('.', $_FILES['arquivo']['name']);
        $extensao = strtolower(end($up));



        if (array_search($extensao, $_UP['extensoes']) === false) {
            echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
            exit;
        }
// Faz a verificação do tamanho do arquivo
        if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
            echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
            exit;
        }
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
// Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()) . '.jpg';
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }

// Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            $img->c_gravar_imagem($ID_CPF_EMPRESA, $nome_final, $_POST['prd_codigo']);
           
            //http://wideimage.sourceforge.net/documentation/loading-images/
           // $image = WideImage::loadFromFile($_UP['path_img'].$nome_final);
           // $resized = $image->resize(355, 460);
           // $resized->saveToFile($nome_final);
        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "Não foi possível enviar o arquivo, tente novamente";
        }
    }
    if ($acao == "excluir") {
        $img->c_excluir_imagem($ID_CPF_EMPRESA, $img_codigo);
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
                            <h3 class="box-title">Cadastro de imagens do produto <?php echo $descricaoproduto ?></h3>
                        </div>                     
                        <form role="form" name="form" id="formulario" method="post" enctype="multipart/form-data" action="CadastraImagem.php" >

                            <input type="hidden" name="prd_codigo" value="<?php echo $prd_codigo ?>" />
                            <input type="hidden" name="descricaoproduto" value="<?php echo $descricaoproduto ?>" /> 
                            <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />

                            <div class="box-body">
                                <input type="file" id="arquivo" name="arquivo" />
                            </div>  

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar Imagem</button>
                                </div>
                            <?php endif; ?>                          
                        </form>
                    </div>  
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">   
                            <?php
                            $img = new ImagensPrdInstance();
                            $imagemBean = new ImagensPrdBean();
                            $imagemBean = $img->c_busca_imagens_produto($ID_CPF_EMPRESA, $prd_codigo);

                            foreach ($imagemBean as $i) :
                                ?>
                                <div class="col-sm-2 col-md-2"> 
                                    <img class="img-responsive" src="../Assets/produtosimg/<?php echo $i->getImg_descricao() ?>" width="120px" heigth="120px" alt="imagem">
                                    <div class="caption">
                                        <?php if ($excluir == "S"): ?>
                                            <div class="box-footer"> 
                                                <a class="btn  btn-danger btn-block btn-xs" href="javascript:if(confirm('EXCLUIR IMAGEM ? ')){location='CadastraImagem.php?descricaoproduto=<?php echo $descricaoproduto ?>&prd_codigo=<?php echo $prd_codigo ?>&acao=excluir&img_codigo=<?php echo $i->getImg_codigo() ?>';}"><i class="fa fa-trash" aria-hidden="true"></i> Excluir</a>
                                            </div> 
                                        <?php endif; ?>                                        
                                    </div>                                    
                                </div> 
                            <?php endforeach; ?>
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