<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$cidade = new CidadesInstace();
$cidadeBean = new CidadesBean();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("clientes");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$rel = $_GET["rel"];

if ($visualizar == "N") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

$rel = $_GET["rel"];
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
                
                
                      <?php 
                      $cliente = new ClientesInstance();
                      $c_busca_cliente = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
                      if (count($c_busca_cliente) > 0) {  ?>

                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">                                   
                                            <a class="btn btn-danger  btn-sm" title="info"  href="../CLIENTES/UpdateClienteCadastradoOFFLINE.php?ID_CPF_EMPRESA=<?php echo $ID_CPF_EMPRESA ?>" target="Frame1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ATENÇÃO ATUALIZE CLIENTES QUE FORAM CADASTRADOS OFF LINE NO CELULAR ANDROID</a>
                                        </div>
                                    </div>
                                </div>
                            </div>                   

                        <?php } ?>
                
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Imprimir relatórios de Clientes por <?php echo $rel ?></h3>
                        </div> 

                        <!-- // relatorio de clientes por cidade -->
                        <!-- // relatorio de clientes por cidade -->
                        <?php if ($rel == "CIDADE") : ?>
                            <form role="form" class="form-group" name="form"  method="post"  autocomplete="off" action="Imprimir_relatorio_cliente.php">
                                <input type="hidden" name="tipo_consulta" value="filtrar_clientes_por_cidade" />
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="box-body">
                                                    <label class="control-label" for="inputSuccess1"> Cidade</label>
                                                    <select class="form-control select2"  name="cid_nome">
                                                        <?php
                                                        $cidadeBean = $cidade->c_busca_todas_cidades_relatorio_cliente();
                                                        foreach ($cidadeBean as $cid) {
                                                            ?>    
                                                            <option   value="<?php echo $cid->getCid_nome() ?>"><?php echo $cid->getCid_nome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                              
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-print" aria-hidden="true"></i> imprimir</button>
                                </div>
                            </form>
                        <?php endif; ?>

                        <!-- // relatorio de clientes por vendedor -->
                        <!-- // relatorio de clientes por vendedor -->
                        <?php if ($rel == "VENDEDOR") : ?>
                            <form role="form" class="form-group" name="form"  method="post"  autocomplete="off" action="Imprimir_relatorio_cliente.php">
                                <input type="hidden" name="tipo_consulta" value="filtrar_clientes_por_vendedor" />
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="box-body">
                                                    <label class="control-label" for="inputSuccess1"> Vendedor</label>
                                                    <select class="form-control select2"  name="usu_nome">
                                                        <?php
                                                        $usuBean = new UsuariosBean();
                                                        $usuario = new UsuariosInstance();
                                                        $usuBean = $usuario->c_buscarUsuariosLiberados($ID_CPF_EMPRESA, "S");
                                                        foreach ($usuBean as $usu) {
                                                            ?>   
                                                            <option   value="<?php echo $usu->getUsu_nome() ?>"><?php echo $usu->getUsu_nome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-print" aria-hidden="true"></i> imprimir</button>
                                </div>
                            </form>
                        <?php endif; ?>

                        <!-- // relatorio de clientes por bairro -->
                        <!-- // relatorio de clientes por bairro -->
                        <?php if ($rel == "BAIRRO") : ?>
                            <form role="form" class="form-group" name="form"  method="post"  autocomplete="off" action="Imprimir_relatorio_cliente.php">
                                <input type="hidden" name="tipo_consulta" value="filtrar_clientes_por_bairro" />
                                <div class="box-body">
                                    <div class="col-md-12">

                                        <div class="col-md-5">                                    
                                            <div class="form-group">
                                                <label class="control-label" for="inputSuccess1"> Cidade</label>
                                                <select class="form-control select2"  name="cid_nome">
                                                    <?php
                                                    $cidadeBean = $cidade->c_busca_todas_cidades_relatorio_cliente();
                                                    foreach ($cidadeBean as $cid) {
                                                        ?>    
                                                        <option   value="<?php echo $cid->getCid_nome() ?>"><?php echo $cid->getCid_nome() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">                                    
                                            <div class="form-group">
                                                <label class="control-label" for="inputSuccess1">Nome bairro</label>                          
                                                <input class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="nome do bairro"   placeholder="nome do bairro"  required name="cli_bairro" id="nome" value="" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-print" aria-hidden="true"></i> imprimir</button>
                                </div>
                            </form>
                        <?php endif; ?>

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