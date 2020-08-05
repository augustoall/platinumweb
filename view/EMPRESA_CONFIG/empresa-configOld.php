<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}


//C. Identificação do Emitente da Nota Fiscal eletrônica pag 179

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("empresa_config");
$cidade = new CidadesInstace();
$cidBean = new CidadesBean();


$incluir = $permissaoBean->getPer_incluir();
$alterar = $permissaoBean->getPer_alterar();
$visualizar = $permissaoBean->getPer_visualizar();
$excluir = $permissaoBean->getPer_excluir();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

if ($nivel == 'USER') {
    echo 'Apenas Administradores podem alterar os dados da empresa';
    exit();
}

$empresa_config = new EmpresaConfigInstance();
$emp = new EmpresaConfigBean();
$emp = $empresa_config->c_busca_empresa_config($ID_CPF_EMPRESA);
$codigo = $emp->getEmp_id();


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");

if ($acao != "") {

    if ($acao == "incluir") {

        if (is_null($_POST["cid_codigo"]) || $_POST["cid_codigo"] == "0" || $_POST["cid_codigo"] == "0") {
            echo "<script>alert('Informe a cidade')</script>";
        } else {
            $cidBean = $cidade->c_busca_cidade_por_codigo($_POST["cid_codigo"]);
            $_POST["emp_cod_municipio"] = $cidBean->getCid_codigo();
            $_POST["emp_nome_municipio"] = $cidBean->getCid_nome();
            $_POST["emp_sigla_uf"] = $cidBean->getCid_uf();
            $_POST["emp_codigo_estado"] = $cidBean->getCodigo_estado();
            EmpresaConfigInstance::c_insert();
            header("Location:empresa-config.php");
        }
    }
    if ($acao == "alterar") {

        if (is_null($_POST["emp_cod_municipio"]) || $_POST["emp_cod_municipio"] == "0" || $_POST["emp_codigo_estado"] == "0") {
            echo "<script>alert('Informe a cidade')</script>";
        } else {
            $cidBean = $cidade->c_busca_cidade_por_codigo($_POST["emp_cod_municipio"]);
            $_POST["emp_cod_municipio"] = $cidBean->getCid_codigo();
            $_POST["emp_nome_municipio"] = $cidBean->getCid_nome();
            $_POST["emp_sigla_uf"] = $cidBean->getCid_uf();
            $_POST["emp_codigo_estado"] = $cidBean->getCodigo_estado();
            EmpresaConfigInstance::c_update();
            header("Location:empresa-config.php");
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
        <!-- style select -->
        <link rel="stylesheet" href="../Assets/css/select2.min.css">
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
                            <h3 class="box-title">Dados da Empresa.</h3>
                        </div>                         
                        <form role="form" action="empresa-config.php" method="post" id="frm_empresa_config">                       
                            <input type="hidden" name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp->getEmp_id() ?>" />
                            <input type="hidden" name="ID_CPF_EMPRESA" id="ID_CPF_EMPRESA" value="<?php echo $_SESSION["ID_CPF_EMPRESA"] ?>" />
                            <input  type="hidden" name="emp_nome_pais" id="emp_nome_pais" value="BRASIL" />
                            <input  type="hidden" name="emp_cod_pais" id="emp_cod_pais" value="1058" />

                            <div class="box-body">

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Razão Social.:</label>                          
                                        <input class="form-control" type="text" placeholder="Ex.:Nome de registro da empresa" required name="emp_razaosocial" id="emp_razaosocial" value="<?php echo $emp->getEmp_razaosocial() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Nome Fantasia.:</label>                          
                                        <input class="form-control" type="text" placeholder="Ex.:Bar do Zé pequeno" required name="emp_nomefantasia" id="emp_nomefantasia" value="<?php echo $emp->getEmp_nomefantasia() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
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


                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Cidade.:.:</label>  
                                        <select   class="form-control select2"  id="cid_codigo" name="cid_codigo">

                                        </select>                                    
                                    </div>
                                </div>


                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">CEP.:</label>                          
                                        <input class="form-control" type="text" placeholder="99999-000" required name="emp_cep" id="emp_cep" value="<?php echo $emp->getEmp_cep() ?>" />
                                    </div>
                                </div>


                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">CNPJ.:</label>                          
                                        <input class="form-control" type="text" placeholder="99.999.999/9999-99" required name="emp_cnpj" id="emp_cnpj" value="<?php echo $emp->getEmp_cnpj() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">CPF.:</label>                          
                                        <input class="form-control" type="text" placeholder="000.000.000-00"  required name="emp_cpf" id="emp_cpf" value="<?php echo $emp->getEmp_cpf() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Cód. Regime Trib. (CRT).:</label>                          
                                        <input class="form-control" maxlength="1" type="text" placeholder="1=Simples Nacional" required name="emp_crt" id="emp_crt" value="<?php echo $emp->getEmp_crt() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Endereço.:</label>                          
                                        <input class="form-control" type="text" placeholder="Ex.: Avenida Santos dumont"  required name="emp_endereco" id="emp_endereco" value="<?php echo $emp->getEmp_endereco() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Número.:</label>                          
                                        <input class="form-control" type="text"   required name="emp_numero" id="emp_numero" value="<?php echo $emp->getEmp_numero() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Complemento.:</label>                          
                                        <input class="form-control" type="text" placeholder="Ex.: Casa / Ap / Comercio / Industria" required name="emp_complemento" id="emp_complemento" value="<?php echo $emp->getEmp_complemento() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Bairro.:</label>                          
                                        <input class="form-control" type="text" placeholder="Ex.: Industrial Anhanguera" required name="emp_bairro" id="emp_bairro" value="<?php echo $emp->getEmp_bairro() ?>" />
                                    </div>
                                </div>




                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Contato 1</label>                          
                                        <input class="form-control" type="text"   required name="emp_contato1" placeholder="(xx)9-9911-0011" id="emp_contato1" value="<?php echo $emp->getEmp_contato1() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Contato 2</label>                          
                                        <input class="form-control" type="text"   required name="emp_contato2" id="emp_contato2"  placeholder="(xx)3811-0011" value="<?php echo $emp->getEmp_contato2() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Insc. Estadual.:</label>                          
                                        <input class="form-control" maxlength="14" placeholder="Inscrição Estadual do Emitente" type="text" required name="emp_ie" id="emp_ie" value="<?php echo $emp->getEmp_ie() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">IEST.:</label>                          
                                        <input class="form-control"  maxlength="14" type="text" placeholder="IE do Substituto Tributário" required name="emp_iest" id="emp_iest" value="<?php echo $emp->getEmp_iest() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">Insc. Municipal.:</label>                          
                                        <input class="form-control" type="text" maxlength="15" placeholder="Insc. Mun. Prestador de Serviço" required name="emp_insc_mun" id="emp_insc_mun" value="<?php echo $emp->getEmp_insc_mun() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <label class="control-label">CNAE.: (opcional)</label>                          
                                        <input class="form-control" maxlength="7" type="text" placeholder="informe se IM for informada" required name="emp_cnae" id="emp_cnae" value="<?php echo $emp->getEmp_cnae() ?>" />
                                    </div>
                                </div>



                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Email</label>                          
                                        <input class="form-control" type="text" placeholder="empresa@gmail.com"   required name="emp_email" id="emp_email" value="<?php echo $emp->getEmp_email() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Facebook</label>                          
                                        <input class="form-control" type="text"  placeholder="fã page / profile facebook"  name="emp_facebook" id="emp_facebook" value="<?php echo $emp->getEmp_facebook() ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label class="control-label" >Site</label>                          
                                        <input class="form-control" type="text" placeholder="www.minhaempresa.com.br"  name="emp_siteurl" id="emp_siteurl" value="<?php echo $emp->getEmp_siteurl() ?>" />
                                    </div>
                                </div>



                            </div>

                            <?php if ($codigo <= 0) : ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Adicionar</button>
                                </div>
                            <?php endif; ?>


                            <?php if ($codigo > 0): ?>
                                <div class="box-footer"> 
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
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
        <script type="text/javascript" src="ajax_buscar_cidades.js?v=2"></script>
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
                $('#emp_cep').mask("99999-999");
                $('#emp_cpf').mask("999.999.999-99");
                $('#emp_contato1').mask("(99)9-9999-9999");
                $('#emp_contato2').mask("(99)9999-9999");
                $('#emp_cnpj').mask("99.999.999/9999-99");
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