<?php

ob_start();
require_once '../../../includes/load__class__file_path_3.php';
if (!Util::verifica_sessao()) {
    header("location:../../../sessao-expirada.php");
    exit();
}

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
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
$vendaCBean = $vendaC->c_busca_clientes_que_compram_mais($_SESSION["ID_CPF_EMPRESA"]);

if (count($vendaCBean) <= 0) {
    echo file_get_contents('../../nenhum-registro-encontrado.php');
    exit();
}

if (is_null($logoBean->getLgm_nomelogo())) {
    $img.='<img src="../../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img.='<img src="../../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}

$cabecalho = ' *****  ' . $empresa_configBean->getEmp_nomefantasia() . ' ***** Emissão : {DATE d/m/y}  ****** IMPRESSÃO DE VENDA  ******* {PAGENO} de {nbpg} paginas';


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
                        <th align=left class="titulos">Nome cliente</th>
                        <th align=left class="titulos">Quantidade de compras</th>
                        <th align=right class="titulos">Total</th>                                             
                    </tr>
                </thead>';
$html .= '<tbody>';

foreach ($vendaCBean as $info_venda) {
    $html .= '<tr>';
    $html .= '<td align=left class="linhas_itens">' . $info_venda["vendac_cli_nome"] . '</td>';
    $html .= '<td align=center class="linhas_itens">' . $info_venda["compras"] . '</td>';
    $html .= '<td align=right class="linhas_itens">' . number_format($info_venda["total"], 2, ',', '.') . '</td>';
    $tot = $tot + $info_venda["total"];
    $html .= '</tr>';
}

$html .= '<tr>';
$html .= '<td align=right colspan="3" class="subtotal">' . number_format($tot, 2, ',', '.') . '</td>';

$html .= '</tr>';
$html .= '</thead>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();




