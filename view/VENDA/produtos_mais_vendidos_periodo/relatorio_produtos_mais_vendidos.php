<?php

ob_start();
require_once '../../../includes/load__class__file_path_3.php';
if (!Util::verifica_sessao()) {
    header("location:../../../sessao-expirada.php");
    exit();
}

$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();

if ($visualizar == "N") {
    echo file_get_contents('../../sem-permissao-visualizar.php');
    exit();
}

include '../../Assets/libs/mpdf60/mpdf.php';
$mpdf = new mPDF();

$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();

$vendaC = new VendaInstance();
$vendaCBean = new VendacBean();
$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();

$cabecalho = "DATA EMISSÃO : {DATE d/m/Y} ** RELATÓRIO DE PRODUTOS MAIS VENDIDOS ** CENTRAL META DE VENDAS ** PÁG. Nº [{PAGENO}]";


$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);
$vendaCBean = $vendaC->c_busca_produtos_mais_vendidos_POR_PERIODO(Util::format_AAAA_MM_DD($data_inicial), Util::format_AAAA_MM_DD($data_final), $_SESSION["ID_CPF_EMPRESA"]);

if (count($vendaCBean) <= 0) {
    echo file_get_contents('../../nenhum-registro-encontrado.php');
    exit();
}

$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
if (is_null($logoBean->getLgm_nomelogo())) {
    $img.='<img src="../../LOGOMARCAS/img_logos/semfoto.jpg"  width="100px" heigth="100px" />';
} else {
    $img.='<img src="../../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="100px" heigth="100px" />';
}


$html .= '<span class="pedido"> Período .: ' . $data_inicial . '  À  ' . $data_final . ' *** ' . Util::retorna_diferenca_2_datas($data_inicial, $data_final) . ' dias <br/></span>';
$html .= '<br>';
$html .= '<br>';
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
                        <th align=left class="titulos">Código</th>
                        <th align=left class="titulos">EAN-13</th>
                        <th align=left class="titulos">Descrição</th>
                        <th align=left class="titulos">Estoque</th>
                        <th align=left class="titulos">Vendida</th>                        
                    </tr>
                </thead>';
$html .= '<tbody>';

foreach ($vendaCBean as $ven) {
    $html .='<tr>';
    $html .='<td  align=left  class="linhas_itens" >' . $ven['cod'] . ' </td> ';
    $html .='<td  align=left  class="linhas_itens" >' . $ven['ean'] . ' </td> ';
    $html .='<td  align=left  class="linhas_itens" >' . $ven['descr'] . '</td>';
    $html .='<td  align=left  class="linhas_itens" >' . $ven['estoq'] . '</td>';
    $html .='<td  align=center  class="linhas_itens" >' . $ven['qtd'] . '</td> ';
    $html .='</tr>';
}
$html .= '</thead>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
