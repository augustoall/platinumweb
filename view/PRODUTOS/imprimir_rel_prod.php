<?php

ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

$prd_produtos = (isset($_POST["produto"])) ? $_POST["produto"] : ((isset($_GET["produto"])) ? $_GET["produto"] : "");


$permisao = new PermissoesInstance();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("produtos");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();
if ($visualizar == "N") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}

define('_MPDF_URI', '../Assets/libs/mpdf60/');
include '../Assets/libs/mpdf60/mpdf.php';

$produto = new ProdutosInstance();
$prodBean = new ProdutoBean();
$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();
$mpdf = new mPDF();

$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);

$log = new LogInstance();
$log->c_inserir_log('PRODUTOS', 'IMPRESSAO DE RELATORIO DE PRODUTOS  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);

if (is_null($logoBean->getLgm_nomelogo())) {
    $img.='<img src="../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img.='<img src="../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}


if ($prd_produtos > 0) {
    $prodBean = $produto->c_buscarTodosProdutosPorCategoria($_SESSION["ID_CPF_EMPRESA"], $prd_produtos);
}

if ($prd_produtos == "sem_estoque") {
    $prodBean = $produto->c_buscarTodosProdutosSemEstoque($_SESSION["ID_CPF_EMPRESA"]);
}

if ($prd_produtos == "all") {
    $prodBean = $produto->C_buscarTodosProdutos_ATIVOS($_SESSION["ID_CPF_EMPRESA"]);
}

if ($prd_produtos == "inativos") {
    $prodBean = $produto->c_buscarTodosProdutos_INATIVOS($_SESSION["ID_CPF_EMPRESA"]);
}

if (count($prodBean) <= 0) {
    echo file_get_contents('../nenhum-registro-encontrado.php');
    exit();
}

$cabecalho = ' *****  ' . $empresa_configBean->getEmp_nomefantasia() . ' ***** Emissão : {DATE d/m/y}  ****** RELATÓRIO DE PRODUTOS  ******* {PAGENO} de {nbpg} paginas';


$html .= '        
             <table style="padding:2px; width:100%;">            
                    <tr>                
                        <td align="center">' . $img . '</td>
                        <td align="center"  colspan="10" >                    
                            <b align="center" class="cabecalho_venda_titulo">' . $empresa_configBean->getEmp_nomefantasia() . '</b> <br> 
                            <b align="left">Cidade.:</b>' . $empresa_configBean->getEmp_nome_municipio() . '<br>
                            <b align="left">Endereço.:</b>' . $empresa_configBean->getEmp_endereco() .' - '. $empresa_configBean->getEmp_numero(). '<br>
                            <b>Bairro.:</b>' . $empresa_configBean->getEmp_bairro() . '                               
                            <b>CEP.:</b>' . $empresa_configBean->getEmp_cep() . '
                            <b>CNPJ.:</b>' . $empresa_configBean->getEmp_cnpj() . '<br>                                                   
                            <b style="text-align:center">Tel.:' . $empresa_configBean->getEmp_contato1() . '/' . $empresa_configBean->getEmp_contato2() .  '</b> <br>                               
                            <b align="center">E-mail.:</b> ' . $empresa_configBean->getEmp_email() . '<br>
                            <b align="center">Site.:</b> ' . $empresa_configBean->getEmp_siteurl() . ' 
                        </td>                  
                    </tr>
                </table>

                <table class="tabela" cellspacing="2" cellpadding="2">
                <thead>
                    <tr>
                        <th align=left class="titulos">Codigo</th>
                        <th align=left class="titulos">EAN</th>
                        <th align=left class="titulos">Descrição Red</th>
                        <th align=left class="titulos">Custo</th>
                        <th align=left class="titulos">Preço Venda</th>
                        <th align=right class="titulos">Estoque</th>                       
                    </tr>
                </thead>';
$html .= '<tbody>';

foreach ($prodBean as $prd) {
    $html .= '<tr>';
    $html .= '<td align=left class="linhas_itens">' . $prd->getPrd_codigo() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $prd->getPrd_EAN() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $prd->getPrd_descr_red() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . number_format($prd->getPrd_custo(), 2, ',', '.') . '..' . '</td>';
    $html .= '<td align=left class="linhas_itens">' . number_format($prd->getPrd_preco(), 2, ',', '.') . '</td>';
    $html .= '<td align=right class="linhas_itens">' . $prd->getPrd_quant() . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
