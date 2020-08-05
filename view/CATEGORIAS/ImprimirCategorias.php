<?php

ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}

define('_MPDF_URI', '../Assets/libs/mpdf60/');
include_once'../Assets/libs/mpdf60/mpdf.php';
$mpdf = new mPDF();

$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();
$categoria = new CategoriasInstance();
$categoriaBean = new CategoriasBean();


$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
$categoriaBean = $categoria->c_buscaTodasCategorias($_SESSION["ID_CPF_EMPRESA"]);
$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);


if (count($categoriaBean) <= 0) {
    echo file_get_contents('../nenhum-registro-encontrado.php');
    exit();
}

if (is_null($logoBean->getLgm_nomelogo())) {
    $img .= '<img src="../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img .= '<img src="../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}


$cabecalho = ' *****  ' . $empresa_configBean->getEmp_nomefantasia() . ' ***** Emissão : {DATE d/m/y}  ****** RELATÓRIO DE CATEGORIA  ******* {PAGENO} de {nbpg} paginas';


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
                        <th align=left class="titulos">Descrição</th>                                   
                    </tr>
                </thead>';
$html .= '<tbody>';


foreach ($categoriaBean as $data) {
    $html .= '<tr>';
    $html .= '<td align=left class="linhas_itens">' . $data->getCat_codigo() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $data->getCat_descricao() . '</td>';

    $html .= '</tr>';
}

$html .= '</thead>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
