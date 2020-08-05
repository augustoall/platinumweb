<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$empresa = new EmpresaInstance();
$empBean = new EmpresaBean();

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





$empBean = $empresa->c_busca_datas_de_validades_diretor($_GET["emp_celularkey"]);
$dias = Util::retorna_diferenca_2_datas(Util::format_DD_MM_AAAA($empBean->getEmp_inicio()), Util::format_DD_MM_AAAA($empBean->getEmp_fim()));


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["emp_codigo"])) ? $_POST["emp_codigo"] : ((isset($_GET["emp_codigo"])) ? $_GET["emp_codigo"] : 0);


if ($codigo > 0) {
    $empBean = $empresa->c_bsuca_empresa_por_codigo();
}

if ($acao != "") {
    if ($acao = "alterar") {
        $empresa->c_atualiza_empresa_na_administracao();
        $log = new LogInstance();
        $log->c_inserir_log('EMPRESA', 'ALTERAR DATA->> ' . Util::format_AAAA_MM_DD($_POST["emp_fim"]) . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
        header("Location:ListaEmpresa.php");
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


                        <form role="form" action="AdministraEmpresa.php" method="post" id="frm">      
                            <input type="hidden"  name="acao" id="acao" value="alterar" />
                            <input type="hidden"  name="emp_codigo" id="cli_codigo" value="<?php echo $empBean->getEmp_codigo() ?>" />
                            <input type="hidden"  name="usu_codigo" id="usu_codigo" value="<?php echo $empBean->getUsu_codigo() ?>" />
                            <input type="hidden"  name="emp_celularkey" id="emp_celularkey" value="<?php echo $empBean->getEmp_celularkey() ?>" />
                            <input type="hidden"  name="emp_totalemdias" id="emp_totalemdias" value="<?php echo $empBean->getEmp_totalemdias() ?>" />                   
                            <input type="hidden"  name="emp_email" id="emp_email" value="<?php echo $empBean->getEmp_email() ?>" />   




                            <div class="box-body">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="">Usuario liberado :  <?php echo $empBean->getLiberado() ?></label>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="">Nome do Usuario  : <?php echo $empBean->getNome_usuario() ?></label>
                                    </div>
                                </div>


                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="l">Numero celular   : <?php echo $empBean->getNumero_celular() ?></label>           
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="">Email de login   :  <?php echo $empBean->getEmail_usuario() ?></label>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="">Senha usuario    : <?php echo $empBean->getCpf_usuario() ?></label>
                                    </div>
                                </div>
                            </div>


                            <div class="box-body">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="blog-post-meta">Código:</label>
                                        <input class="form-control" type="text" readonly name="codigo" id="CO" value="<?php echo $empBean->getEmp_codigo() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="blog-post-meta">cpf empresa:</label>
                                        <input class="form-control" type="text" readonly name="emp_cpf" value="<?php echo $empBean->getEmp_cpf() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">cliente desde:</label>
                                        <input class="form-control" type="text" readonly required name="emp_datapedido" id="emp_datapedido" value="<?php echo $empBean->getEmp_datapedido() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">celular do usuário:</label>
                                        <input class="form-control" type="text" readonly required name="emp_numerocelular" id="emp_numerocelular" value="<?php echo $empBean->getEmp_numerocelular() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">nome empresa:</label>
                                        <input class="form-control" type="text" readonly required name="emp_nome" id="nome" value="<?php echo $empBean->getEmp_nome() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">Dias Restantes</label>
                                        <input class="form-control" readonly type="text"  required name="dias_restantes" value="<?php echo $dias ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">data início:</label>
                                        <input class="form-control" type="text" readonly required name="emp_inicio" id="emp_inicio" value="<?php echo $empBean->getEmp_inicio() ?>" />
                                    </div>
                                </div>


                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">data fim: determine o fim da licença</label>
                                        <input class="form-control" type="text" required name="emp_fim" id="emp_fim" value="<?php echo $empBean->getEmp_fim() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label  class="blog-post-meta">chave de licença:</label>
                                        <input class="form-control" type="text" required name="emp_licenca" id="cli_nascimento" value="<?php echo $empBean->getEmp_licenca() ?>" />
                                    </div>
                                </div>



                            </div>                           
                            <div class="box-footer"> 
                                <button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Editar</button>
                              
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
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  
    </body>
</html>