<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$usuarioBean = new UsuariosBean();
$usuario = new UsuariosInstance();

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
$SESSION_CODIGO_USUARIO = $_SESSION["usu_codigo"];
/* * ********************************************************************** */

$img = new ImagensPrdInstance();
$imagemBean = new ImagensPrdBean();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vendas</title>

        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../Assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <script src="jquery.js" type="text/javascript"></script>
        <script src="detalhe.js" type="text/javascript"></script>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row-fluid">
                <?php
                $cliente = new ClientesInstance();
                $c_busca_cliente = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
                if (count($c_busca_cliente) > 0) {
                    ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">                                   
                                    <a class="btn btn-danger  btn-sm" title="info"  href="../../CLIENTES/UpdateClienteCadastradoOFFLINE.php?ID_CPF_EMPRESA=<?php echo $ID_CPF_EMPRESA ?>" target="Frame1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ATENÇÃO ATUALIZE CLIENTES QUE FORAM CADASTRADOS OFF LINE NO CELULAR ANDROID</a>
                                </div>
                            </div>
                        </div>
                    </div>                   

                <?php } ?>
                <br>
                <br>

                <p class="lead blog-description">Listagem das Últimas Vendas <a class="btn btn-default btn-lg" href="../loginadm.php">voltar</a></p>
                <?php if ($visualizar == "S") { ?>


                    <table id="tbVendas" class="table table-striped" rules="rows">

                        <thead>
                            <tr>
                                <th></th>
                                <th>Num.Pedido</th>
                                <th>Vendedor</th>
                                <th>Cliente</th>
                                <th>DataHora</th>
                                <th>Entrega</th>
                                <th>Pagamento</th>                                   
                                <th>Total</th>
                                <th>PDF</th>
                                <th>Cupom</th>
                            </tr>                            				
                        </thead> 
                        <tbody>

                            <?php
                            $venda = new VendaInstance();

                            if ($nivel == "DIRETOR") {
                                $vendaBean = $venda->c_listar_todas_vendasc_para_diretor();
                            }

                            if ($nivel == "ADM") {
                                $vendaBean = $venda->c_buscar_todas_vendasc($ID_CPF_EMPRESA);
                            }

                            if ($nivel == "USER") {
                                $vendaBean = $venda->c_buscar_apenas_vendas_vendedor($ID_CPF_EMPRESA, $SESSION_CODIGO_USUARIO);
                            }

                            $total = count($vendaBean);

                            foreach ($vendaBean as $ven) {

                                $vendedor = $ven->getVendac_usu_codigo();

                                $usuarioBean = $usuario->c_BuscarUsuarioPorCodigo($ID_CPF_EMPRESA, $vendedor);
                                ?>

                                <tr class="linhaVenda">
                                    <td></td>
                                    <td><?php echo $ven->getVendac_chave() ?></td>
                                    <td><?php echo $usuarioBean->getUsu_nome() ?></td>
                                    <td><?php echo $ven->getVendac_cli_nome() ?></td>
                                    <td><?php echo Util::format_DD_MM_AAAA_HHMMSS($ven->getVendac_datahoravenda()) ?></td>
                                    <td><?php echo Util::format_DD_MM_AAAA($ven->getVendac_previsao_entrega()) ?></td>
                                    <td><?php echo $ven->getVendac_fpgto_tipo() ?></td>                                       
                                    <td><?php echo $ven->getVendac_valor() ?></td>
                                    <td><a class="btn btn-default"  title="imprimir em pdf" href="relatorios_gerais_vendas/ImprimirVenda.php?vendac_chave=<?php echo $ven->getVendac_chave() ?>"><span  class="glyphicon glyphicon-print"></span></a></td>  
                                    <td><a class="btn btn-default"  title="Cupom Fiscal" href="bematechMP20mi.php?vendac_chave=<?php echo $ven->getVendac_chave() ?>"><span  class="glyphicon glyphicon-print"></span></a></td>  
                                </tr>
                                <tr class="linhaItens">
                                    <td colspan="8">
                                        <table class="tbItens table  table-condensed" rules="rows">
                                            <thead>
                                                <tr colspan="8">
                                                    <th>Item</th>
                                                    <th>cod.Barras</th>
                                                    <th>cod.Produto</th>
                                                    <th>Descricao Produto</th>
                                                    <th>Quantidade vendida</th>
                                                    <th>Preco</th>
                                                    <th>total item</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $detalhes_venda = new VendadBean();


                                                if ($nivel == "ADM") {
                                                    $detalhes_venda = $venda->DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $ven->getVendac_chave());
                                                }

                                                if ($nivel == "USER") {
                                                    $detalhes_venda = $venda->DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $ven->getVendac_chave());
                                                }

                                                if ($nivel == "DIRETOR") {
                                                    $detalhes_venda = $venda->c_buscar_itens_da_venda_por_vendac_chave_para_diretor($ven->getVendac_chave());
                                                }

                                                foreach ($detalhes_venda as $itens_venda) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $itens_venda->getVendad_nro_item() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_ean() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_codigo_produto() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_descricao_produto() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_quantidade() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_precovenda() ?></td>
                                                        <td><?php echo $itens_venda->getVendad_total() ?></td>

                                                    </tr>


                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>

                    </table>
                    </td>
                    </tr>

                    <tbody>
                        </table>  

                    <div class="alert alert-success">
                        <strong><?php echo $total . '  registros encontrados' ?></strong>
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