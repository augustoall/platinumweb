<?php
ob_start();
require_once '../includes/load__class__file_path_1.php';
if (!Util::verifica_sessao()) {
    header("location:../sessao-expirada.php");
    exit();
}

require_once '../includes/load__class__file_path_1.php';
include_once '../view/LOGOMARCAS/inc/WideImage/WideImage.php';

$empBean = new EmpresaBean ();
$empresa = new EmpresaInstance ();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();

$usuario = new UsuariosInstance();
$usuarioBean = new UsuariosBean();
$usuarioBean = $usuario->c_BuscaUsuarioPor_usu_cel_key($_SESSION["ID_CPF_EMPRESA"], $_SESSION["usu_celularkey"]);

$permissaoBean = $permisao->c_buscarPermParaTabelaDe("empresa");
$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$logo = new LogomarcasInstance();

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");

if ($acao == "incluir") {
    $logo->c_gravar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
}

$cliente = new ClientesInstance();
$cliBean = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
?>   

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>home</title>

        <link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="Assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />           
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!-- Main component for a primary marketing message or call to action -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Painel Principal - Usuário <?php echo $nivel ?>
            </div>
            <?php if ($nivel == "DIRETOR" || $nivel == "ADM") : ?>
            
            <div class="panel-body">  

                <?php if (count($cliBean) > 0) { ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">                                   
                                    <a class="btn btn-danger  btn-sm" title="info"  href="CLIENTES/UpdateClienteCadastradoOFFLINE.php?ID_CPF_EMPRESA=<?php echo $ID_CPF_EMPRESA ?>" target="Frame1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ATENÇÃO ATUALIZE CLIENTES QUE FORAM CADASTRADOS OFF LINE NO CELULAR ANDROID</a>
                                </div>
                            </div>
                        </div>
                    </div>                   

                <?php } ?>

                <?php
                $logoBean = new LogomarcasBean();
                $logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);

                if (is_null($logoBean->getLgm_nomelogo())) {
                    ?>    

                    <form  name="form" id="formulario" method="post" enctype="multipart/form-data" action="home.php"> 
                        <input type="file" id="imagem" name="logomarca" />
                        <input type="hidden"  name="acao" value="incluir" />
                        <div class="clear"></div>  
                        <br/>
                        <button class="btn btn-success" type="submit"  ><i class="icon-share-alt icon-white"></i>Inserir Logomarca</button>
                    </form>

                    <br/>
                    <p><img src="LOGOMARCAS/img_logos/semfoto.jpg"  width="100px" heigth="30px" /></p> 

                    <?php
                } else {
                    ?>
                    <p><img src="LOGOMARCAS/img_logos/<?php echo $logoBean->getLgm_nomelogo() ?>" width="70px" heigth="70px" /></p>

                <?php } ?>
            </div>
            
            
            
            <div class="panel-footer">
                Sistema de Gerenciamento de Vendas Externas
            </div>
            
            <?php endif;?>
        </div>        
    </body>
</html>