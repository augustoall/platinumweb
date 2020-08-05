<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$usuBean = new UsuariosBean();
$usuario = new UsuariosInstance();

$vendac = new VendaInstance();
        

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("usuarios");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
/* * **************************************************************** */

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["usu_codigo"])) ? $_POST["usu_codigo"] : ((isset($_GET["usu_codigo"])) ? $_GET["usu_codigo"] : 0);

if ($codigo > 0) {
    $usuBean = $usuario->c_BuscaUsuarioPorCodigo($ID_CPF_EMPRESA);
}

if ($acao != "") {
    if ($acao == "alterar") {
        $usuario->c_AtualizaUsuario($ID_CPF_EMPRESA);
        
        // atualizando o nome do vendedor nas em suas vendas
        $usuBean = $usuario->c_BuscarUsuarioPorCodigo($ID_CPF_EMPRESA,$codigo);        
        $vendac->c_atualiza_nome_vendedor_vendac($usuBean->getUsu_nome(),$codigo, $ID_CPF_EMPRESA);
        
        header("Location:./ListaUsuarios.php");
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
                            <h3 class="box-title">Editar Usuário / Vendedor</h3>
                        </div>                     
                        <form role="form" action="CadastraUsuarios.php" method="post" id="form_categoria">
                            <input type="hidden" name="acao" id="acao" value="alterar" />
                            <input type="hidden" name="usu_codigo" id="usu_codigo" value="<?php echo $usuBean->getUsu_codigo() ?>" />
                            <input type="hidden" name="usu_numerocelular" id="usu_numerocelular" value="<?php echo $usuBean->getUsu_numerocelular() ?>" />


                            <div class="box-body">

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Codigo</label>
                                        <input class="form-control" type="text" disabled name="CO" id="CO" value="<?php echo $usuBean->getUsu_codigo() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Celular</label>
                                        <input class="form-control" type="text" disabled placeholder="cel:" name="usu_numerocelular" id="usu_numerocelular" value="<?php echo $usuBean->getUsu_numerocelular() ?>" />
                                    </div>
                                </div> 

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Vendedor</label>
                                        <input class="form-control" type="text" placeholder="ex:antonio silva" name="usu_nome" id="usu_nome" value="<?php echo $usuBean->getUsu_nome() ?>" />
                                    </div>
                                </div>


                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Senha</label>
                                        <input class="form-control" type="password" placeholder="senha de login" name="usu_cpf" id="usu_cpf" value="<?php echo $usuBean->getUsu_cpf() ?>" />
                                    </div>
                                </div>  


                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">E-mail / login</label>
                                        <input class="form-control" type="text" placeholder="@email" name="usu_email" id="usu_email" value="<?php echo $usuBean->getUsu_email() ?>" />
                                    </div>
                                </div> 


                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Marca do telefone</label>
                                        <input class="form-control"  type="text"  name="usu_dispositivo" id="usu_dispositivo" value="<?php echo $usuBean->getUsu_dispositivo() ?>" />
                                    </div>
                                </div> 

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Desconto liberado</label>
                                        <input class="form-control" type="text" placeholder="desc." name="usu_desconto" <?php echo ($nivel =="USER") ? "readonly" : "" ?> id="usu_desconto" value="<?php echo $usuBean->getUsu_desconto() ?>" />
                                    </div>
                                </div> 

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Comissao</label>
                                        <input class="form-control" type="text" placeholder="com." name="usu_comissao" <?php echo ($nivel =="USER") ? "readonly" : "" ?> id="usu_comissao" value="<?php echo $usuBean->getUsu_comissao() ?>" />
                                    </div>
                                </div> 



                            </div> 

                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Usuário</button>
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