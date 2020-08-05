<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}
$produto = new ProdutosInstance();
$prodBean = new ProdutoBean();
$log = new LogInstance();
$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("produtos");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
/***************************************************** */

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["prd_codigo"])) ? $_POST["prd_codigo"] : ((isset($_GET["prd_codigo"])) ? $_GET["prd_codigo"] : 0);

if ($codigo > 0) {
    $prodBean = $produto->C_buscaProdutoPorCodigo($ID_CPF_EMPRESA, $codigo);
}

if ($acao != "") {
    if ($acao == "incluir") {

        // se o usuario nao indicar o fornecedor ou categoria
        if ($_POST["for_codigo"] == "0" || $_POST["cat_codigo"] == "0") {
            echo "<script>history.back()</script>";
        } else {
            if ($produto->C_gravarProduto($ID_CPF_EMPRESA)) {
                $log->c_inserir_log('PRODUTOS', 'GRAVAR->> ' . Util::remover_letra_acentuada($_POST["prd_descricao"]) . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
                header("Location:ListaProdutos.php");
            } 
        }
    } elseif ($acao == "alterar") {
        // se o usuario nao indicar o fornecedor ou categoria
        if ($_POST["for_codigo"] == "0" || $_POST["cat_codigo"] == "0") {
            echo "<script>history.back()</script>";
        } else {
            if ($produto->C_alterarProduto($ID_CPF_EMPRESA)) {
                $log->c_inserir_log('PRODUTOS', 'ALTERAR->> ' . Util::remover_letra_acentuada($_POST["prd_descricao"]) . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
                header("Location:ListaProdutos.php");
            }
        }
    } elseif ($acao == "excluir") {
        if ($produto->C_excluirProduto($ID_CPF_EMPRESA)) {
            $log->c_inserir_log('PRODUTOS', 'EXCLUIR->> ' . $_GET["prd_codigo"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaProdutos.php");
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


                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                                <a class="btn btn-mini btn-success btn-xs" title="cadastrar"  href="../FORNECEDOR/CadastraFornecedor.php?retorno=produtos"><i class="fa fa-plus" aria-hidden="true"></i>
                                    cadastrar fornecedor</a>

                                <a class="btn btn-mini btn-success btn-xs" title="cadastrar"  href="../CATEGORIAS/CadastraCategorias.php?retorno=produtos"><i class="fa fa-plus" aria-hidden="true"></i>
                                    cadastrar categoria</a>

                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cadastro de Produtos  - QUANTIDADE, CUSTO e PREÇO SÃO INFORMADOS <a class="btn btn-info btn-xs" href="../ENTRPRODUTO/CadastraEntradaProduto.php">Aqui</a></h3>
                        </div>                     
                        <form name="frm_produtos" id="frm_fornecedor" method="post" action="CadastraProdutos.php" role="form">
                            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                            <input type="hidden" name="prd_codigo" value="<?php echo $prodBean->getPrd_codigo() ?>" />

                            <div class="box-body">
                                <div class="col-md-12">
                                    <label class="control-label" data-toggle="tooltip" data-placement="bottom" title="codigo nao pode ser informado" for="inputSuccess1">Código</label>                          
                                    <input  class="form-control"  disabled type="text" name="prd_codigo" value="<?php echo $prodBean->getPrd_codigo() ?>" />
                                </div>


                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> Fornecedor</label>

                                    <select   class="form-control select2"  data-toggle="tooltip" data-placement="bottom" title=""    name="for_codigo"  >
                                        <option value="0" >[Selecione...]</option>
                                        <?php
                                        $fornecedor = new FornecedoresInstancce();
                                        $fornBean = $fornecedor->C_buscaTodosFornecedores($ID_CPF_EMPRESA);
                                        $count = 0;
                                        foreach ($fornBean as $p) {
                                            $count++;
                                            ?>

                                            <option   <?php echo ($prodBean->getFor_codigo() == $p->getFor_codigo()) ? "selected" : "" ?>   value="<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_fantasia() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> categoria
                                    </label>
                                    <select   class="form-control select2"  data-toggle="tooltip" data-placement="bottom" title=""    name="cat_codigo"  >
                                        <option value="0" >[Selecione...]</option>
                                        <?php
                                        $categoria = new CategoriasInstance();
                                        $categoriaBean = new CategoriasBean();
                                        $categoriaBean = $categoria->c_buscaTodasCategorias($ID_CPF_EMPRESA);
                                        foreach ($categoriaBean as $data) {
                                            ?>
                                            <option  <?php echo ($prodBean->getCat_codigo() == $data->getCat_codigo()) ? "selected" : "" ?>   value="<?php echo $data->getCat_codigo() ?>"><?php echo $data->getCat_descricao() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> ativo:</label>
                                    <select   class="form-control select2"  data-toggle="tooltip" data-placement="bottom" title="este produto esta ativo no seu estoque ?"    name="prd_ativo"  >                           
                                        <option <?php echo ( $prodBean->getPrd_ativo() == "S" ) ? "selected" : "" ?> value="S">sim</option>
                                        <option <?php echo ( $prodBean->getPrd_ativo() == "N" ) ? "selected" : "" ?>  value="N">não</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> EAN-13:</label>
                                    <input  class="form-control"  data-toggle="tooltip" data-placement="bottom" title="o codigo ean-13 é o mesmo que o codigo de barras, é importante informa-lo para pesquisas futuras" type="text" required maxlength="13"  placeholder="código de barras ean-13" name="prd_EAN"  value="<?php echo $prodBean->getPrd_EAN() ?>" />
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> descrição:</label>
                                    <input  class="form-control"  data-toggle="tooltip" data-placement="bottom" title="descricao completa deste produto" type="text"  required   placeholder="descrição" name="prd_descricao"  value="<?php echo $prodBean->getPrd_descricao() ?>" />
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> descrição reduzida:</label>
                                    <input class="form-control"  data-toggle="tooltip" data-placement="bottom" title="uma descricao abreviada deste produto"    type="text"  required   placeholder="uma descricao abreviada" name="prd_descr_red"  value="<?php echo $prodBean->getPrd_descr_red() ?>" />
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="control-label" for="inputSuccess1"> unidade medida:</label>
                                    <select   class="form-control select2"  data-toggle="tooltip" data-placement="bottom" title="unidade de medida do produto Ex litro ,caixa , kilo..."    name="prd_unmed"  >
                                        <option <?php echo ($prodBean->getPrd_unmed() == "UN" ) ? "selected" : "" ?> value="UN">unidade</option>
                                        <option <?php echo ($prodBean->getPrd_unmed() == "CX" ) ? "selected" : "" ?> value="CX">caixa</option>
                                        <option  <?php echo ($prodBean->getPrd_unmed() == "LT" ) ? "selected" : "" ?> value="LT">litro</option>
                                        <option <?php echo ($prodBean->getPrd_unmed() == "KG" ) ? "selected" : "" ?>  value="KG">kilo</option>
                                        <option <?php echo ($prodBean->getPrd_unmed() == "G" ) ? "selected" : "" ?> value="G">grama</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label" for="inputSuccess1"> Obs:</label>
                                    <input  class="form-control"  data-toggle="tooltip" data-placement="bottom" title="observação nao é obrigatoria" type="text"    placeholder="obs" name="prd_obs"  value="<?php echo $prodBean->getPrd_obs() ?>" />
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> quantidade:  informada na entrada de produtos</label>
                                    <input class="form-control"     type="text"  readonly  placeholder="estoque" name="prd_quant"  value="<?php echo ($codigo > 0) ? $prodBean->getPrd_quant() : 0 ?>" />
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> custo:  informado na entrada de produtos</label>
                                    <input  class="form-control"   type="text" readonly   placeholder="custo" name="prd_custo" id="prd_custo"  value="<?php echo ($codigo > 0) ? $prodBean->getPrd_custo() : 0 ?>" />
                                </div>  

                                <div class="col-md-4">
                                    <label class="control-label" for="inputSuccess1"> preço de venda:  informado na entrada de produtos</label>
                                    <input  class="form-control"   type="text"  readonly  placeholder="venda" name="prd_preco" id="prd_preco"  value="<?php echo ($codigo > 0) ? $prodBean->getPrd_preco() : 0 ?>" />
                                </div>

                            </div><!--box-body-->

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar Produto</button>
                                </div>
                            <?php endif; ?>
                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Produto</button>
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
        <!-- mask-input -->
        <script src="../Assets/js/jquery.mask.js"></script>  
        <!--  selects -->
        <script src="../Assets/js/select2.full.min.js"></script>    
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".select2").select2();
                $('#prd_preco').mask("###0,00", {reverse: true});
                $('#prd_custo').mask("###0,00", {reverse: true});
            });
        </script>
    </body>
</html>