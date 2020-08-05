<?php

ob_start();
require_once '../../../includes/load__class__file_path_3.php';
if (!Util::verifica_sessao()) {
    header("location:../../../sessao-expirada.php");
    exit();
}

$cli_nome = $_POST["cli_nome"];
$html_inicial = $_POST['data_inicial'];
$html_final = $_POST['data_final'];
$filtrar_conta = $_POST['filtrar_conta'];


define('_MPDF_URI', '../../Assets/libs/mpdf60/');
include '../../Assets/libs/mpdf60/mpdf.php';

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("receber");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
if ($visualizar == "N") {
    echo file_get_contents('../../sem-permissao-visualizar.php');
    exit();
}

$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();
$clienteBean = new ClientesBean();
$cliente = new ClientesInstance();
$usuarioBean = new UsuariosBean();
$usuario = new UsuariosInstance();
$vendaC = new VendaInstance();
$vendaCBean = new VendacBean();
$receber = new ReceberInstance();
$recBean = new ReceberBean();
$confpagBean = new confPagamentoBean();
$confpag = new ConfPagamentoInstace();
$cheque = new ChequesInstance();
$chequeBean = new ChequesBean();
$mpdf = new mPDF();


$cabecalho = "EMISSÃO : {DATE d/m/Y} ** RELATÓRIO DE CONTAS A RECEBER POR CLIENTE **  [ {PAGENO} de {nbpg} paginas ] ";

$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);
$clienteBean = $cliente->c_buscaClientePorNome($ID_CPF_EMPRESA, trim($cli_nome));

if (is_null($clienteBean->getCli_codigo())) {
    $html .= '<br/>';
    $html .= '<h3>Nenhum cliente foi encontrado com o nome infomado</h3>';
    $mpdf->SetDisplayMode('fullwidth', 'single');
    $stylesheet = file_get_contents('../estilo.css');
    $mpdf->SetHeader($cabecalho);
    $mpdf->SetWatermarkImage('../../LOGOMARCAS/img_logos/cmdvic.png');
    $mpdf->showWatermarkImage = true;
    $mpdf->watermarkImageAlpha = 0.1;
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit();
}



if ($filtrar_conta == "ABERTO") {
    $recBean = $receber->c_busca_contas_EM_ABERTO_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $clienteBean->getCli_codigo(), $html_inicial, $html_final);
}
if ($filtrar_conta == "PAGAS") {
    $recBean = $receber->c_busca_contas_PAGAS_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $clienteBean->getCli_codigo(), $html_inicial, $html_final);
}
if ($filtrar_conta == "TODAS") {
    $recBean = $receber->c_busca_contas_TODAS_por_rec_cli_codigo_ADM($ID_CPF_EMPRESA, $clienteBean->getCli_codigo(), $html_inicial, $html_final);
}



if (count($recBean) <= 0) {
    echo file_get_contents('../../nenhum-registro-encontrado.php');
    exit();
}

$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
if (is_null($logoBean->getLgm_nomelogo())) {
    $img .= '<img src="../../LOGOMARCAS/img_logos/semfoto.jpg"  width="100px" heigth="100px" />';
} else {
    $img .= '<img src="../../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="100px" heigth="100px" />';
}


$html .= '<table border=1 style="padding:2px; width:100%;">            
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
                    <tr>                
                        <td align="center" colspan="11"> Contas de ' . $clienteBean->getCli_nome() . '</td>
                                        
                    </tr>
                </table>';




$html .= '<table class="tabela" cellspacing="2" width:100%; cellpadding="2">
                <thead>
                    <tr>
                    <th align=left class="titulos">Venda</th>
                        <th align=center class="titulos">Parcela</th>
                        <th align=left class="titulos">Vencimento</th>
                        <th align=left class="titulos">Valor-Receber</th>
                        <th align=right class="titulos">Valor-Pago</th>                                      
                    </tr>
                </thead>';
$html .= '<tbody>';

$total = 0;
$pagas = 0;
$parcelas_rec = 0;
foreach ($recBean as $parcela) {

    if ($parcela->getRec_num_parcela() < 10) {
        $numero_parcela = '0' . $parcela->getRec_num_parcela();
    }

    $html .= '<tr>';
    $html .= '<td align=left class="linhas_itens">' . $parcela->getVendac_chave() . '</td>';
    $html .= '<td align=center class="linhas_itens">' . $numero_parcela . '</td>';
    $html .= '<td align=left class="linhas_itens">' . Util::format_DD_MM_AAAA($parcela->getRec_datavencimento()) . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $parcela->getRec_valorreceber() . '</td>';
    $html .= '<td align=right class="linhas_itens">' . $parcela->getRec_valor_pago() . '</td>';
    $total = $total + $parcela->getRec_valorreceber();
    $pagas = $pagas + $parcela->getRec_valor_pago();

    $html .= '</tr>';
}

$parcelas_rec = $total - $pagas;


$html .= '<tr>';
$html .= '<td align=right colspan="4" class="subtotal">Total Pago</td>';
$html .= '<td align=right class="subtotal">' . number_format($pagas, 2, '.', '') . '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td align=right colspan="4" class="subtotal">Tota a Receber</td>';
$html .= '<td align=right class="subtotal">' . number_format($parcelas_rec, 2, '.', '') . '</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->progbar_altHTML = '<html><body>
	<div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 18px;"><img style="vertical-align: middle" src="../../LOGOMARCAS/img_logos/loading.gif" /> Criando Relatório em arquivo PDF. Aguarde...</div>';
$mpdf->StartProgressBarOutput();
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
