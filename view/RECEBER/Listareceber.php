<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("receber");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
/* * **************************************************************** */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


        <title>Consulta de Contas a receber</title>
        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../Assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js/jquery-11.js"></script> 	
        <script type="text/javascript" src="../js/filtro_tabela.js"></script> 	


    </head>
    <body >
        <br/>
        <div class="container-fluid">
            <div class="row">

               <?php
                $cliente = new ClientesInstance();
                $c_busca_cliente = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
                if (count($c_busca_cliente) > 0) {
                    ?>

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

                <div class="form-group has-success  col-xs-6">
                    <p class="lead blog-description">Consulta de Clientes</p>
                </div>

                <div class="clear"></div>
                <?php if ($incluir == "S") { ?>
                    <button type="button" class="btn btn-success btn-xs" value="cadastrar" onClick="location.href = '#'"><span class="glyphicon glyphicon-plus"></span> Cadastrar</button>
                <?php } ?>

                <button type="button" class="btn btn-default btn-xs" value="busca" onClick="location.href = '#'"><span class="glyphicon glyphicon-search"></span> Pesquisa Avançada</button>

                <br/>

                <?php if ($visualizar == "S") { ?>
                    <table id="tabela" class="table table-condensed table-hover">

                        <thead>
                            <tr>

                                <td>Parcela</td>
                                <td>Cliente</td>
                                <td>Data Venda</td>
                                <td>Data Venc.</td>
                                <td>Valor Receber</td>
                                <td>Data Pagamento</td>
                                <td>Valor Pago</td>
                            </tr>
                            <tr>
                                <th><input  style="width:100px;" type="text" id="txtColuna1"/></th>
                                <th><input  style="width:100px;" type="text" id="txtColuna2"/></th>
                                <th><input  style="width:100px;" type="text" id="txtColuna3"/></th>
                                <th><input  style="width:100px;" type="text" id="txtColuna3"/></th>
                                <th><input  style="width:100px;" type="text" id="txtColuna3"/></th>
                                <th><input  style="width:100px;" type="text" id="txtColuna3"/></th>
                            </tr>				
                        </thead> 

                        <tbody>
                            <?php
                            $cliente = new ClientesInstance();
                            $cliBean = new ClientesBean();

                            $receber = new ReceberInstance();
                            $receBean = new ReceberBean();


                            if ($nivel == "ADM") {
                                
                            }

                            if ($nivel == "USER") {
                                
                            }

                            if ($nivel == "DIRETOR") {
                                
                            }


                            $cont = count($cliBean);
                            foreach ($cliBean as $cli) {
                                ?>
                                <tr>

                                    <td class="blog-post-meta"><?php echo $cli->getCli_nome() ?></td>
                                    <td class="blog-post-meta"><?php echo $cli->getCli_cpfcnpj() ?></td>
                                    <td class="blog-post-meta"><?php echo $cli->getCid_nome() ?> </td>
                                    <td class="blog-post-meta"><?php echo $cli->getCli_bairro() ?></td>                       
                                    <td class="blog-post-meta"><?php echo $cli->getCli_contato1() ?></td>                                  
                                    <td class="blog-post-meta"><?php echo $cli->getCli_email() ?></td>

                                    <td>

                                        <div class="btn-group">
                                            <?php if ($alterar == "S") { ?>
                                                <a class="btn btn-warning btn-xs"  title="Editar" href="CadastraClientes.php?cli_codigo=<?php echo $cli->getCli_codigo() ?>"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                                            <?php } ?>

                                            <?php if ($excluir == "S") { ?>  
                                                <a class="btn btn-danger btn-xs" title="Excluir"  href="javascript:if(confirm('Deseja excluir o cliente <?php echo $cli->getCli_nome() ?> ?')) {location='CadastraClientes.php?acao=excluir&cli_codigo=<?php echo $cli->getCli_codigo() ?> ';}"><span class="glyphicon glyphicon-trash"></span> Excluir</a>
                                            <?php } ?>

                                        </div>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>

                    <div class="alert alert-success">
                        <strong><?php echo $cont . ' Registro(s) encontrado(s).' ?></strong>
                    </div> 
                <?php } else { ?>
                    <div class="alert alert-danger">
                        <strong><?php echo 'sem permissão para visualizar' ?></strong>
                    </div> 
                <?php } ?>
            </div>
        </div>
    </body>
</html>