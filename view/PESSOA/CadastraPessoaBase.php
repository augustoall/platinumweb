<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$cidade = new CidadesInstace();
$cidadeBean = new CidadesBean();
$cliente = new ClientesInstance();
$cliBean = new ClientesBean();

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("clientes");

$log = new LogInstance();

$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
/* * **************************************************************** */

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["cli_codigo"])) ? $_POST["cli_codigo"] : ((isset($_GET["cli_codigo"])) ? $_GET["cli_codigo"] : 0);

if ($codigo > 0) {
    $cliBean = $cliente->C_buscarClientePorCodigo($ID_CPF_EMPRESA);
}

if ($acao != "") {

    if ($acao == "incluir") {

        if (is_null($_POST["cid_codigo"]) || $_POST["cid_codigo"] == "0") {
            echo "<script>alert('Informe a cidade')</script>";
            echo "<script>window.history.go(-1);</script>";
        } else {

            $cidBean = $cidade->c_busca_cidade_por_codigo($_POST["cid_codigo"]);
            $_POST["cid_codigo"] = $cidBean->getCid_codigo();
            $_POST["cli_nomecidade"] = $cidBean->getCid_nome();
            $_POST["cli_siglaestado"] = $cidBean->getCid_uf();
            $cliente->c_grava_cliente_web($ID_CPF_EMPRESA);
            $log->c_inserir_log('CLIENTES', 'GRAVAR->> ' . $_POST ["cli_nome"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaClientes.php");
        }
    }


    if ($acao == "alterar") {

        if (is_null($_POST["cid_codigo"]) || $_POST["cid_codigo"] == "0") {
            echo "<script>alert('Informe a cidade')</script>";
            echo "<script>window.history.go(-1);</script>";
        } else {

            $cidBean = $cidade->c_busca_cidade_por_codigo($_POST["cid_codigo"]);
            $_POST["cid_codigo"] = $cidBean->getCid_codigo();
            $_POST["cli_nomecidade"] = $cidBean->getCid_nome();
            $_POST["cli_siglaestado"] = $cidBean->getCid_uf();

            $cliente->c_alterar_cliente_web($ID_CPF_EMPRESA);
            $log->c_inserir_log('CLIENTES', 'ALTERAR->> ' . $_POST ["cli_nome"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
            header("Location:ListaClientes.php");
        }
    }



    if ($acao == "excluir") {
        $cliente->C_excluirCliente($ID_CPF_EMPRESA);
        $log->c_inserir_log('CLIENTES', 'EXCLUIR->> ' . $_GET ["cli_codigo"] . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);
        header("Location:ListaClientes.php");
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


                <?php
                $c_busca_cliente = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);
                if (count($c_busca_cliente) > 0) {
                    ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="dataTable_wrapper">                                   
                                    <a class="btn btn-danger  btn-sm" title="info"  href="../CLIENTES/UpdateClienteCadastradoOFFLINE.php?ID_CPF_EMPRESA=<?php echo $ID_CPF_EMPRESA ?>" target="Frame1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ATENÇÃO ATUALIZE CLIENTES QUE FORAM CADASTRADOS OFF LINE NO CELULAR ANDROID</a>
                                </div>
                            </div>
                        </div>
                    </div>                   

                <?php } ?>

                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cadastro de Pessoa Base</h3>
                        </div>                     
                        <form name="form" id="form" method="post"  action="CadastraPessoaBase.php">
                            <div id="inic"></div>
                            <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                            <input type="hidden"  name="cli_codigo" id="cli_codigo" value="<?php echo $cliBean->getCli_codigo() ?>" />                           

                            <div class="box-body">


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" data-toggle="tooltip" data-placement="bottom" title="codigo nao pode ser informado">Código.:</label>                          
                                        <input tabindex="1" class="form-control"  type="text" disabled name="CO" id="CO" value="<?php echo $cliBean->getCli_codigo() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label">Razão Social.:</label>                          
                                        <input tabindex="1"  class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="Ex.:Nome de registro da empresa"   placeholder=" Ex.: Nome de registro da empresa"  required name="cli_nome" id="nome" value="<?php echo $cliBean->getCli_nome() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label  class="control-label">Nome Fantasia.:</label>
                                        <input tabindex="1"  class="form-control"  type="text" data-toggle="tooltip" data-placement="bottom" title="nome fantasia" placeholder=" Ex.: Nome fantasia da empresa" required name="cli_fantasia" id="cli_fantasia" value="<?php echo $cliBean->getCli_fantasia() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Data de nascimento.:</label>                          
                                        <input tabindex="1" class="form-control"  maxlength="10"   type="text" title="data no formato dia/mes/ano"   placeholder=" Ex.: 14/09/1980" id="cli_nascimento" name="cli_nascimento" id="cli_nascimento" value="<?php echo $cliBean->getCli_nascimento() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
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


                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Cidade.:.:</label>  
                                        <select   class="form-control select2"  id="cid_codigo" name="cid_codigo">

                                        </select>                                    
                                    </div>
                                </div>


                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label">Endereço.:</label>  
                                        <input tabindex="1" class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="endereço do cliente" placeholder=" Ex.: Endereco completo" required name="cli_endereco" id="cli_endereco" value="<?php echo $cliBean->getCli_endereco() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Número.:</label>                          
                                        <input tabindex="1" class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="número do local"   placeholder=" Ex.: Ex:  "  required name="cli_numero" id="cli_numero" value="<?php echo $cliBean->getCli_numero() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Complemento.:</label>                          
                                        <input tabindex="1" class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="complemento"   placeholder=" Ex.: Ex: complemento casa/ap"  name="cli_complemento" id="cli_complemento" value="<?php echo $cliBean->getCli_complemento() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Bairro.:</label>  
                                        <input tabindex="1" class="form-control" type="text"  data-toggle="tooltip" data-placement="bottom" title="bairro logradouro"  placeholder=" Ex.: Bairro" required name="cli_bairro" id="cli_bairro" value="<?php echo $cliBean->getCli_bairro() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Cep.:</label>  
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" data-placement="bottom" title="cep no formato 0000-000" placeholder=" Ex.: CEP" name="cli_cep" required id="cli_cep" value="<?php echo $cliBean->getCli_cep() ?>" />
                                    </div>
                                </div>
                                <div id="mdi"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Contato 1 (celular).:</label>  
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" required  data-placement="bottom" title="(xx)9-0000-0000" placeholder=" Ex.: (xx)9-0000-0000" required name="cli_contato1" id="cli_contato1" value="<?php echo $cliBean->getCli_contato1() ?>" />
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Contato 2 (celular).:</label>   
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input tabindex="1" class="form-control" type="text" data-toggle="tooltip"  data-placement="bottom" title="(xx)9-0000-0000" placeholder=" Ex.: (xx)9-0000-0000" name="cli_contato2" id="cli_contato2" value="<?php echo $cliBean->getCli_contato2() ?>" />
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Contato 1 (fixo):.:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input tabindex="1" class="form-control" type="text" data-toggle="tooltip"  data-placement="bottom" title="(xx)0000-0000" placeholder=" Ex.: (xx)0000-0000" name="cli_contato3" id="cli_contato3" value="<?php echo $cliBean->getCli_contato3() ?>" />
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">E-mail.:</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" data-placement="bottom" title="caso nao possua email , informe contato@gmail.com" placeholder=" Ex.: @email"  required name="cli_email" id="cli_email" value="<?php echo $cliBean->getCli_email() ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label">CPF / CNPJ.:</label>  
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" data-placement="bottom" title="insira cpf válido" placeholder=" Ex.: CPF / CNPJ" required name="cli_cpfcnpj" id="cli_cpfcnpj" value="<?php echo $cliBean->getCli_cpfcnpj() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label">RG / INSC. EST.:</label>  
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip"   data-placement="bottom" title="rg ou a inscricao estadual"  required placeholder=" Ex.: RG / INSC. EST" name="cli_rginscricaoest" id="cli_rginscricaoest" value="<?php echo $cliBean->getCli_rginscricaoest() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Limite.:</label>  
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" <?php echo ($nivel == "USER" ? "readonly" : "") ?> required data-placement="bottom" title="um limite de credito para o cliente" placeholder=" Ex.: 0.00" name="cli_limite" id="cli_limite" value="<?php echo $cliBean->getCli_limite() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label"  for="inputWarning1">Senha.:</label>
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" data-placement="bottom" title="senha do seu cliente"  required name="cli_senha" id="cli_senha" value="<?php echo $cliBean->getCli_senha() ?>" />
                                    </div>
                                </div>


                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Vendedor.:</label>  
                                        <select class="form-control select2" data-toggle="tooltip" data-placement="bottom" title="vincule este cliente a um vendedor ou nao ." name="usu_codigo">
                                            <option value="0">[ NENHUM VENDEDOR PARA ESTE CLIENTE]</option>
                                            <?php
                                            $usuBean = new UsuariosBean();
                                            $usuario = new UsuariosInstance();
                                            $usuBean = $usuario->c_buscarUsuariosLiberados($ID_CPF_EMPRESA, "S");
                                            foreach ($usuBean as $usu) {
                                                ?>   
                                                <option   <?php echo ($cliBean->getUsu_codigo() == $usu->getUsu_codigo()) ? "selected" : "" ?>       value="<?php echo $usu->getUsu_codigo() ?>"><?php echo $usu->getUsu_nome() ?></option>
                                            <?php } ?>
                                        </select>
                                        <a href="#" target="Frame1"  data-toggle="tooltip" data-placement="bottom" title="vinculando este cliente a um vendedor; este vendedor podera importar no celular android somente clientes que foram vinculados a ele aqui. Voce nao precisa informar nada, portanto este cliente podera pertencer a qualquer vendedor de sua empresa. "><i class="fa fa-user-o" aria-hidden="true"></i>
                                            pra que serve vendedor ?</a>
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Observação.:</label>  
                                        <input tabindex="1" class="form-control" type="text" data-toggle="tooltip" data-placement="bottom" title="alguma informaçao que voce ache necessaria" placeholder=" Ex.: Observacao" name="cli_observacao" id="cli_observacao" value="<?php echo $cliBean->getCli_observacao() ?>" />
                                    </div>
                                </div>

                                <div id="fim"></div>
                            </div>



                            <?php if ($incluir == "S" && $codigo == 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar Cliente</button>
                                </div>
                            <?php endif; ?>


                            <?php if ($alterar == "S" && $codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Cliente</button>
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
        <!-- mask-input -->
        <script src="../Assets/js/jquery.mask.js"></script> 
        <!-- Slimscroll -->
        <script src="../Assets/js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../Assets/js/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../Assets/js/app.min.js"></script>  

        <script>
            $(document).ready(function () {
                $('#cli_nascimento').mask("99/99/9999");
                $('#cli_cep').mask("99999-999");
                $('#cli_contato1').mask("(99)9-9999-9999");
                $('#cli_contato2').mask("(99)9-9999-9999");
                $('#cli_contato3').mask("(99)9999-9999");
                $('#cli_limite').mask("###0,00", {reverse: true});

                //select
                $(".select2").select2();
            });


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


        </script>
    </body>
</html>