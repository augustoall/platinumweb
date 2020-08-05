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

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["ent_id"])) ? $_POST["ent_id"] : ((isset($_GET["ent_id"])) ? $_GET["ent_id"] : 0);
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
        <!-- jquery ui css -->
        <link href="../Assets/css/jquery-ui.min.css" rel="stylesheet"> 
        <!-- Bootstrap -->
        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet"> 
        <!-- style select -->
        <link rel="stylesheet" href="../Assets/css/select2.min.css"> 
        <!-- Theme style -->
        <link rel="stylesheet" href="../Assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../Assets/css/skin-blue.css">
        <!-- custom bootstrap -->
        <link rel="stylesheet" href="../Assets/css/bootstrap-custom.css">

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
                            <h3 class="box-title">Entrada de Produtos - Controle de Estoque</h3>
                        </div> 

                        <form method="post" name="frm_entradaprodutos" id="frm_entradaprodutos">                       
                            <input type="hidden" name="ID_CPF_EMPRESA" value="<?php echo $ID_CPF_EMPRESA ?>" />
                            <input type="hidden" name="usu_codigo" value="<?php echo $_SESSION["usu_codigo"] ?>" />
                            <input type="hidden" name="ent_data_entrada" value="<?php echo date('Y-m-d H:m:s') ?>" />

                            <?php if ($incluir == "S"): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Nota de Entrada</button>
                                </div>
                            <?php endif; ?>

                            <div class="box-body">

                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">Código</label>  
                                        <input class="form-control" type="text" readonly value="" name="ent_id" id="ent_id" />
                                    </div>
                                </div>


                                <div class="col-md-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">Usuário:</label> 
                                        <input class="form-control" type="text" readonly value="<?php echo $_SESSION["usu_codigo"] . ' - ' . $_SESSION["usu_nome"] ?>" />
                                    </div>
                                </div>

                                <div class="col-md-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">Data Entrada:</label>  
                                        <input class="form-control" type="text" readonly value="<?php echo date('d/m/Y H:m:s') ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">Número da nota:</label>  
                                        <input class="form-control" maxlength="15" type="text" required value="" name="ent_numeronota" id="ent_numeronota" />
                                    </div>
                                </div>                          

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">Valor da nota:</label>  
                                        <input class="form-control" type="text" required value="" name="ent_valor_nota" id="ent_valor_nota" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> Fornecedor</label>
                                    <select   class="form-control select2" id="for_codigo" name="for_codigo">  
                                        <option value="0">[SELECIONE UM FORNECEDOR]</option>
                                        <?php
                                        $fornecedor = new FornecedoresInstancce();
                                        $fornBean = $fornecedor->C_buscaTodosFornecedores($ID_CPF_EMPRESA);
                                        foreach ($fornBean as $p) {
                                            ?>
                                            <option  value="<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_fantasia() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <div id="mensagem" class="alert alert-warning" role="alert"></div> 
                                </div>
                            </div> 
                        </form>

                        <div id="itens_da_entrada">   
                            <form name="frm_itens" method="post">
                                <input  id="id" name="id" type="hidden"   value="" />                        
                                <input type="hidden" id="ID_CPF_EMPRESA" name="ID_CPF_EMPRESA" value="<?php echo $ID_CPF_EMPRESA ?>" />
                                <input type="hidden" id="entd_margem" name="entd_margem" value="0" />
                                <input type="hidden" id="entd_ean" name="entd_ean" value="" />


                                <div class="box-body">
                                    <div class="col-md-12 col-xs-12">
                                        <div id="msg_sem_item" class="alert alert-warning" role="alert"></div> 
                                    </div>


                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Código:</label> 
                                            <input class="form-control" type="text" readonly value="" name="entd_prd_codigo" id="entd_prd_codigo" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Descrição Produto:</label> 
                                            <input class="form-control" type="text" readonly value="" name="entd_descricaoprd" id="entd_descricaoprd" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Estoque Atual:</label> 
                                            <input class="form-control" type="text" readonly value="" name="qtd" id="qtd" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Preço de Custo:</label> 
                                            <input class="form-control" type="text"  value="" name="entd_custo" id="entd_custo" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Preço de venda:</label> 
                                            <input class="form-control" type="text"  value="" name="entd_preco" id="entd_preco" />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Quantidade Comprada:</label> 
                                            <input class="form-control" type="text"  value="" name="entd_qtd" id="entd_qtd" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="input-group">
                                            <input  class="form-control" placeholder="Digite o nome do produto aqui..." id="busca_produto" type="text"   value="" />     
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Adicionar produto</button>
                                            </span>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div>

                        <div id="itens_adicionados">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>                              
                                        <th>Descrição do Produto</th>
                                        <th>Preço de custo</th>
                                        <th>Preço de venda</th>
                                        <th>Quantidade</th>  
                                        <th>Ação</th> 
                                    </tr>
                                </thead>
                                <tbody id="tabela">
                                </tbody>
                            </table>
                        </div>

                    </div>  


                </div>

            </div>


        </section>     


        <!--  jquery js -->
        <script src="../Assets/js/jquery-3.2.1.min.js"></script>    

        <!--  jquery ui -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="  crossorigin="anonymous"></script>   


        <!--  autocomplete produto js -->
        <script src="../Assets/js/auto-complete-produto.js?v2"></script>  

        <!--  entradaprd js -->
        <!-- script src="../Assets/js/entradaprodutos.js?v2"></script -->       
        <!--  bootstrap js -->
        <script src="../Assets/js/bootstrap.min.js"></script>  
        <!--  selects -->
        <script src="../Assets/js/select2.full.min.js"></script>                
        <!-- mask-input -->
        <script src="../Assets/js/jquery.mask.js"></script> 
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  
        <script src="../ENTRPRODUTO/entradaprodutos.js?<?php rand(0, 1000) ?>"></script>  
        <script type="text/javascript">
            $(function () {
                $(".select2").select2();
                $('#ent_valor_nota').mask("###0,00", {reverse: true});

                $('#entd_preco').mask("###0,00", {reverse: true});
                $('#entd_qtd').mask("###0,00", {reverse: true});
                $('#entd_custo').mask("###0,00", {reverse: true});

            });
        </script>



    </body>
</html>