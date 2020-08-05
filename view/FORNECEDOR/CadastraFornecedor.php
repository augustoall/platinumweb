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
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("fornecedores");

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$fornecedor = new FornecedoresInstancce();
$fornBean = new FornecedoresBean();

$log = new LogInstance();

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["for_codigo"])) ? $_POST["for_codigo"] : ((isset($_GET["for_codigo"])) ? $_GET["for_codigo"] : 0);

$retorno = (isset($_POST["retorno"])) ? $_POST["retorno"] : ((isset($_GET["retorno"])) ? $_GET["retorno"] : "");

if ($codigo > 0) {
    $fornBean = $fornecedor->C_BuscarFornecedorPorCodigo($ID_CPF_EMPRESA);
}


if ($acao != "") {
    if ($acao == "incluir") {
        // se o usuario nao indicar a cidade
        if ($_POST["cid_codigo"] == "0") {
            echo "<script>history.back()</script>";
        } else {
            $fornecedor->C_gravarFornecedores($ID_CPF_EMPRESA);
            $log->c_inserir_log('FORNECEDOR', 'GRAVAR->> ' . $_POST["for_razaosocial"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            if ($retorno == "produtos") {
                header("Location:../PRODUTOS/CadastraProdutos.php");
            } else {
                header("Location:ListaFornecedor.php");
            }
        }
    } elseif ($acao == "alterar") {
        // se o usuario nao indicar a cidade
        if ($_POST["cid_codigo"] == "0") {
            echo "<script>history.back()</script>";
        } else {

            if ($fornecedor->C_editarFornecedores($ID_CPF_EMPRESA)) {
                $log->c_inserir_log('FORNECEDOR', 'ALTERAR->> ' . $_POST["for_razaosocial"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
                header("Location:ListaFornecedor.php");
            }
        }
    } elseif ($acao == "excluir") {
        if ($fornecedor->C_excluirFornecedor($ID_CPF_EMPRESA)) {
            $log->c_inserir_log('FORNECEDOR', 'EXCLUIR->> ' . $_GET["for_codigo"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaFornecedor.php");
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
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cadastro de Fornecedores</h3>
                        </div>                     
                        <form class="form-group" name="frm_fornecedor" id="frm_fornecedor" method="post" action="CadastraFornecedor.php">

                            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                            <input type="hidden" name="for_codigo" value="<?php echo $fornBean->getFor_codigo() ?>" />
                            <input type="hidden"  name="retorno" id="retorno" value="<?php echo $retorno ?>" />                            

                            <div class="box-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1" >Razão Social:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="razao social do cliente"   required   placeholder="razão social" name="for_razaosocial"  value="<?php echo $fornBean->getFor_razaosocial() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1" >Nome Fantasia:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="nome fantasia"    required   placeholder="fantasia" name="for_fantasia"  value="<?php echo $fornBean->getFor_fantasia() ?>" />
                                    </div>
                                </div>

                                  <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Estado.:</label>
                                        <select  class="form-control select2"   id="cid_uf"   name="cid_uf" >                       
                                            <option  value="TT">[ --Selecione o estado-- ]</option>
                                            <option  value="SP">Sao Paulo</option>
                                            <option  value="RJ">Rio de Janeiro</option>
                                            <option  value="AC" >Acre</option>
                                            <option  value="AL">Alagoas</option>                        
                                            <option  value="AP">Amapa</option>
                                            <option  value="AM">Amazonas</option>
                                            <option  value="BA">Bahia</option>
                                            <option  value="CE">Ceara</option>
                                            <option  value="DF">Distrito Federal</option>
                                            <option  value="GO">Goias</option>
                                            <option  value="ES">Espirito Santo</option>
                                            <option  value="MA">Maranhao</option>
                                            <option  value="MT">Mato Grosso</option>
                                            <option  value="MS">Mato Grosso do Sul</option>
                                            <option  value="MG">Minas Gerais</option>
                                            <option  value="PA">Para</option>
                                            <option  value="PB">Paraiba</option>
                                            <option  value="PR">Paraná</option>
                                            <option  value="PE">Pernambuco</option>
                                            <option  value="PI">Piaui­</option>                        
                                            <option  value="RN">Rio Grande do Norte</option>
                                            <option  value="RS">Rio Grande do Sul</option>
                                            <option  value="RO">Rondonia</option>
                                            <option  value="RR">Roraima</option>                        
                                            <option  value="SC">Santa Catarina</option>
                                            <option  value="SE">Sergipe</option>
                                            <option  value="TO">Tocantins</option>                   
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Cidade.:.:</label>  
                                        <select   class="form-control select2"  id="cid_codigo" name="cid_codigo">

                                        </select>                                    
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1">Endereço:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="endereco do cliente"    required   placeholder="endereço" name="for_endereco"  value="<?php echo $fornBean->getFor_endereco() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1">Bairro:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="bairro ou logradouro"   required   placeholder="bairro" name="for_bairro"  value="<?php echo $fornBean->getFor_bairro() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1">Cep:</label>
                                        <input class="form-control" id="for_cep"  type="text"  data-toggle="tooltip" data-placement="bottom" title="cep"   required   placeholder="CEP"  name="for_cep"  value="<?php echo $fornBean->getFor_cep() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1">Cpf/Cnpj:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="cpf ou cnpj valido"   required   placeholder="CNPJ" name="for_cnpjcpf"  value="<?php echo $fornBean->getFor_cnpjcpf() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contato 1 (fixo):</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" data-toggle="tooltip" data-placement="bottom" title="(xx)0000-0000" id="for_contato1" class="form-control"  name="for_contato1" value="<?php echo $fornBean->getFor_contato1() ?>"   >
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contato 2 (celular):</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" data-toggle="tooltip" data-placement="bottom" title="(xx)9-0000-0000" id="for_contato2" class="form-control"  name="for_contato2" value="<?php echo $fornBean->getFor_contato2() ?>"   >
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="inputSuccess1">E-mail</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="e-mail valido"     placeholder="Email" name="for_email"  value="<?php echo $fornBean->getFor_email() ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label   class="control-label" for="inputSuccess1" >Representante:</label>
                                        <input class="form-control"  type="text"  data-toggle="tooltip" data-placement="bottom" title="nome do vendedor representante"     placeholder="representante" name="for_representante" value="<?php echo $fornBean->getFor_representante() ?>" />
                                    </div>
                                </div>                            
                            </div>

                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar Fornecedor</button>
                                </div>
                            <?php endif; ?>


                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Fornecedor</button>
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
        <!--  buscar cidades ajax -->
        <script type="text/javascript" src="ajax_buscar_cidades.js"></script>
        <!--  selects -->
        <script src="../Assets/js/select2.full.min.js"></script>
        <!--  inputmasks -->
        <script src="../Assets/js/jquery.mask.js"></script>  
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  

        <script>
            $(document).ready(function () {

                // inputs
                $('#for_contato1').mask("(99)-9999-9999");
                $('#for_contato2').mask("(99)-9-9999-9999");
                $('#for_cep').mask("99999-999");

                //select
                $(".select2").select2();


                $('#cid_uf').change(function (e) {
                    var cid_uf = $('#cid_uf').val();
                    $.getJSON('ajax_buscar_cidades.php?cid_uf=' + cid_uf, function (dados) {
                        if (dados.length > 0) {
                            $('#cid_codigo').html('')
                            var option = '<option value="0">[ SELECIONE CIDADE ]</option>';
                            $.each(dados, function (i, obj) {
                                option += '<option value="' + obj.cid_codigo + '"  > ' + obj.cid_nome + ' </option>';
                            })
                        } else {
                            alert("nenhuma cidade foi encontrada com este estado")
                        }
                        $('#cid_codigo').html(option).show();
                    })
                })


            });
        </script>
    </body>
</html>