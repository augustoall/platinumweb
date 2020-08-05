<?php
ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("CHAVE_DE_LICENCA");
$nivel = $permissaoBean->getPer_nivel();
if ($nivel == "DIRETOR") {

    $ID_CPF_EMPRESA = $_POST["ID"];

    $categoria = new CategoriasDao();
    $cheques = new ChequesDao();
    $clientes = new ClientesDao();
    $confpagamento = new conPagamentoDao();
    $empresa = new EmpresaDao();
    $fornecedor = new FornecedoresDao();
    $historicoPgto = new HistoricoPgtoDao();
    $imagensprd = new ImagensPrdDao();
    $logomarcas = new LogomarcasDao();
    $permissoes = new PermissoesDao();
    $produtos = new ProdutoDao();
    $receber = new ReceberDao();
    $usuario = new UsuariosDao();
    $vendac = new VendacDao();
    $vendad = new VendadDao();

    $categoria->m_EXCLUIR_CATEGORIA_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $cheques->m_EXCLUIR_CHEQUES_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $clientes->m_EXCLUIR_CLIENTES_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $confpagamento->m_EXCLUIR_CONFPAGAMENTO_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $empresa->m_EXCLUIR_EMPRESA_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $fornecedor->m_EXCLUIR_FORNECEDORES_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $historicoPgto->m_EXCLUIR_HISTORICOPAGAMENTO_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $imagensprd->m_EXCLUIR_IMAGENSPRD_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $logomarcas->m_EXCLUIR_LOGOMARCAS_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $permissoes->m_EXCLUIR_PERMISSOES_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $produtos->m_EXCLUIR_PRODUTOS_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $receber->m_EXCLUIR_RECEBER_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $usuario->m_EXCLUIR_USUARIOS_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $vendac->m_EXCLUIR_VENDAC_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    $vendad->m_EXCLUIR_VENDAD_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >

                <title></title>               
                <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <link href="../Assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />     

        </head>
        <body>
            <br/>
            <div class="container">    
                <div class="row">

                    <form   class="form-group" name="form" id="form" method="post" action="Excuir_empresas_inativas.php">                

                        <div class="clear" ></div>
                        <div class="form-group has-success  col-xs-1">
                            <label class="control-label" for="inputSuccess1">.</label> 
                            <button class="btn btn-success btn-xs"  data-toggle="tooltip" data-placement="right" title="incluir dias" type="submit"  value="cadastrar"><span class="glyphicon glyphicon-floppy-saved"></span>Excluir</button>
                        </div>

                        <div class="clear" ></div>
                        <div class="col-md-12 col-xs-3">
                            <label class="control-label" for="inputSuccess1">CPF DA EMPRESA A SER ELIMINADA</label>                          
                            <input class="form-control input-sm" type="text" data-toggle="tooltip" data-placement="right" title="dias a serem incluidos"  placeholder="cpf da empresa"  required name="ID" id="ID" value="" />
                        </div>

                    </form>
                </div>
        </body>
    </html>
    <?php
}
?>
