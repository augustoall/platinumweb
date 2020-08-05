<?php
ob_start();
require_once '../../../includes/load__class__file_path_3.php';
if (!Util::verifica_sessao()) {
    header("location:../../../sessao-expirada.php");
    exit();
}

$data_inicial = $_POST["data_inicial"];
$data_final = $_POST["data_final"];
$imprimeitens = $_POST["IMPRIME_ITENS"];

$permisao = new PermissoesInstance();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();

if ($visualizar == "N") {
    echo file_get_contents('../../sem-permissao-visualizar.php');
    exit();
}

define('_MPDF_URI', '../../Assets/libs/mpdf60/');
include '../../Assets/libs/mpdf60/mpdf.php';

$mpdf = new mPDF();
$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();
$vendaC = new VendaInstance();
$vendaCBean = new VendacBean();
$vendaDBean = new VendadBean();

$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);

$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);


if (is_null($logoBean->getLgm_nomelogo())) {
    $img.='<img src="../../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img.='<img src="../../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}

$cabecalho = ' *****  ' . $empresa_configBean->getEmp_nomefantasia() . ' ***** Emissão : {DATE d/m/y}  ****** IMPRESSÃO DE VENDA  ******* {PAGENO} de {nbpg} paginas';


if ($nivel == "DIRETOR") {
    $vendaCBean = $vendaC->c_busca_vendas_DIRETOR_por_periodo($data_inicial, $data_final);
}

if ($nivel == "ADM") {
    $vendaCBean = $vendaC->c_busca_vendac_por_periodo($_SESSION["ID_CPF_EMPRESA"], $data_inicial, $data_final);  
}

if ($nivel == "USER") {
    $vendaCBean = $vendaC->c_busca_vendas_do_vendedor_por_periodo($_SESSION["ID_CPF_EMPRESA"], $data_inicial, $data_final);
}

if (count($vendaCBean) <= 0) {
    echo file_get_contents('../../nenhum-registro-encontrado.php');
    exit();
}



//imprime a venda sem os itens
if (!$imprimeitens) {
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
                        <th align=left class="titulos">CodVenda</th>
                        <th align=left class="titulos">Data</th>
                        <th align=left class="titulos">Cliente</th>
                        <th align=left class="titulos">Vendedor</th>
                        <th align=left class="titulos">Pagamento</th>
                        <th align=right class="titulos">Valor</th>                       
                    </tr>
                </thead>';
    $html .= '<tbody>';

    $tot = 0;
    foreach ($vendaCBean as $info_venda) {
        $html .= '<tr>';
        $html .= '<td align=left class="linhas_itens">' . $info_venda->getVendac_chave() . '</td>';
        $html .= '<td align=left class="linhas_itens">' . Util::format_DD_MM_AAAA_HHMMSS($info_venda->getVendac_datahoravenda()) . '</td>';
        $html .= '<td align=left class="linhas_itens">' . $info_venda->getVendac_cli_nome() . '</td>';
        $html .= '<td align=left class="linhas_itens">' . substr($info_venda->getVendac_usu_nome(), 0, 5) . '..' . '</td>';
        $html .= '<td align=left class="linhas_itens">' . $info_venda->getVendac_fpgto_tipo() . '</td>';
        $html .= '<td align=right class="linhas_itens">' . number_format($info_venda->getVendac_valor(), 2, ',', '.') . '</td>';
        $tot = $tot + $info_venda->getVendac_valor();
        $html .= '</tr>';
    }

    $html .= '<tr>';
    $html .= '<td align=right colspan="4" class="subtotal">Total</td>';
    $html .= '<td align=right class="subtotal">' . number_format($tot, 2, ',', '.') . '</td>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '</table>';
}


// imprime a venda com todos os itens
if ($imprimeitens) {

    $html .= '<table style="padding:2px; width:100%;">            
                    <tr>                
                        <td align="center">' . $img . '</td>
                        <td align="center"  colspan="10" >                    
                            <b align="center" class="cabecalho_venda_titulo">' . $empresa_configBean->getEmp_nome() . '</b> <br> 
                            <b align="left">Cidade.:</b>' . $empresa_configBean->getEmp_cidade() . '<br>
                            <b align="left">Endereço.:</b>' . $empresa_configBean->getEmp_endereco() . '<br>
                            <b>Bairro.:</b>' . $empresa_configBean->getEmp_bairro() . '                               
                            <b>CEP.:</b>' . $empresa_configBean->getEmp_cep() . '
                            <b>CNPJ.:</b>' . $empresa_configBean->getEmp_cnpj() . '<br>                                                   
                            <b style="text-align:center">Tel.:' . $empresa_configBean->getEmp_contato1() . '/' . $empresa_configBean->getEmp_contato2() . '/' . $empresa_configBean->getEmp_contato3() . '</b> <br>                               
                            <b align="center">E-mail.:</b> ' . $empresa_configBean->getEmp_email() . '<br>
                            <b align="center">Site.:</b> ' . $empresa_configBean->getEmp_siteurl() . ' 
                        </td>                  
                    </tr>
                </table>
            <br>
            <br>';

    foreach ($vendaCBean as $venda) {

        $vendaDBean = $vendaC->DETALHESc_buscar_itens_da_venda_por_vendac_chave($_SESSION["ID_CPF_EMPRESA"], $venda->getVendac_chave());

        $html .= '<table style="padding:2px; width:100%;">
        <thead>
                <tr>
                  <td valign="top" align="left"><b>Venda.: </b></td>
                  <td colspan="10">' . $venda->getVendac_chave() . '</td>                  
                </tr>                
                <tr>
                    <td valign="bottom" align="left"><b>Data Venda.: </b></td>
                    <td colspan="3" align="left"> ' . $venda->getVendac_datahoravenda() . '</td>            
                </tr>                
                <tr>
                    <td align="left"><b>Cliente.:</b></td>
                    <td colspan="3"> ' . $venda->getVendac_cli_nome() . ' </td>
                    <td align="right"><b>Vendedor.:</b></td>
                    <td colspan="6"> ' . $venda->getVendac_usu_nome() . '</td>
                </tr>                
                <tr>
                    <td valign="top" align="left"><b>Valor.: </b></td>
                    <td colspan="10"><b>' . number_format($venda->getVendac_valor(), 2, ',', '.') . '</b></td>                   
                </tr>          
                <tr>
                    <td colspan="11" align="left"><b>Observação.:  ' . $venda->getVendac_observacao() . ' </b></td>
                </tr>
                </thead>
            </table>';
        $html .= '<table class="tabela" cellspacing="2" cellpadding="2">';
        $html .= '<thead>
                <tr>
                <th align=center class="titulos">CodProd</th>
                <th align=left class="titulos">Descrição do Produto</th>
                <th align=left class="titulos">Quant.</th>
                <th align=left class="titulos">Valor Unit.</th>
                <th align=right class="titulos">Total</th>
                </tr>
                </thead>';
        $html .= '<tbody>';

        $tot = 0;
        foreach ($vendaDBean as $itens_venda) {
            $html .= '<tr>';
            $html .= '<td align=center class="linhas_itens">' . $itens_venda->getVendad_codigo_produto() . '</td>';
            $html .= '<td align=left class="linhas_itens"> ' . $itens_venda->getVendad_descricao_produto() . '</td>';
            $html .= '<td align=left class="linhas_itens">' . $itens_venda->getVendad_quantidade() . '</td>';
            $html .= '<td align=left class="linhas_itens">' . number_format($itens_venda->getVendad_precovenda(), 2, ',', '.') . '</td>';
            $html .= '<td align=right class="linhas_itens">' . number_format($itens_venda->getVendad_total(), 2, ',', '.') . '</td>';
            $html .= '</tr>';
            $tot += $itens_venda->getVendad_total();
        }

        $html .= '<tr>';
        $html .= '<td align=right colspan="4" class="subtotal">Total</td>';
        $html .= '<td align=right class="subtotal">' . number_format($tot, 2, ',', '.') . '</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
    }
}


$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
