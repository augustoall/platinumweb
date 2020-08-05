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
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();

$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];
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
$vendaDBean = new VendadBean();


$vendac_chave = $_REQUEST["vendac_chave"];


$empresa_configBean = $empresa_config->c_busca_empresa_config($ID_CPF_EMPRESA);
$logoBean = $logo->c_buscar_logomarca($ID_CPF_EMPRESA);


$cabecalho = ' ***' . $empresa_configBean->getEmp_nomefantasia() . ' *** Emissão : {DATE d/m/y} *** IMPRESSÃO DE VENDA *** {PAGENO} de {nbpg} paginas';


if ($nivel == "DIRETOR") {
    $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave_para_diretor($vendac_chave);
}

if ($nivel == "ADM") {
    $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
}

if ($nivel == "USER") {
    $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
}

if (is_null($logoBean->getLgm_nomelogo())) {
    $img .= '<img src="../../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img .= '<img src="../../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}


$html .= '<table style="padding:2px; width:100%;">            
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
                </table>';
$html .= '<br/>';


$html .= '<table style="padding:2px; width:100%;">
        <thead>
                <tr>
                  <td valign="top" align="left"><b>Venda.: </b></td>
                  <td colspan="10">' . $vendaCBean->getVendac_chave() . '</td>                  
                </tr>                
                <tr>
                    <td valign="bottom" align="left"><b>Data Venda.: </b></td>
                    <td colspan="3" align="left"> ' . $vendaCBean->getVendac_datahoravenda() . '</td>            
                </tr>                
                <tr>
                    <td align="left"><b>Cliente.:</b></td>
                    <td colspan="3"> ' . $vendaCBean->getVendac_cli_nome() . ' </td>
                    <td align="right"><b>Vendedor.:</b></td>
                    <td colspan="6"> ' . $vendaCBean->getVendac_usu_nome() . '</td>
                </tr>                
                <tr>
                    <td valign="top" align="left"><b>Valor.: </b></td>
                    <td colspan="10"><b>' . number_format($vendaCBean->getVendac_valor(), 2, ',', '.') . '</b></td>                   
                </tr>';


$confpagBean = $confpag->c_buscar_confpagamento_por_chave($ID_CPF_EMPRESA, $vendac_chave);
if ($confpagBean->getPag_sementrada_comentrada() == 'false' && $confpagBean->getPag_recebeucom_din_chq_cart() == 'DINHEIRO' && $confpagBean->getPag_tipo_pagamento() == 'AVISTA') {
    $html .= '<tr>
                    <td colspan="11" align="left"><b>Tipo Pagamento.: ' . $confpagBean->getPag_tipo_pagamento() . ' - DINHEIRO' . '</b></td>
               </tr>';

    $html .= '<tr>
                    <td colspan="11" align="left"><b>Venda a vista.:  </b></td>
              </tr>';
}

if ($confpagBean->getPag_sementrada_comentrada() == 'false' && $confpagBean->getPag_recebeucom_din_chq_cart() == 'CARTAO' && $confpagBean->getPag_tipo_pagamento() == 'AVISTA') {
    $html .= '<tr>
                    <td colspan="11" align="left"><b>Tipo Pagamento.: ' . $confpagBean->getPag_tipo_pagamento() . ' - CARTAO  em ' . $confpagBean->getPag_parcelas_cartao() . 'x   </b></td>
               </tr>';
}

if ($confpagBean->getPag_sementrada_comentrada() == 'false' && $confpagBean->getPag_recebeucom_din_chq_cart() == 'CHEQUE' && $confpagBean->getPag_tipo_pagamento() == 'AVISTA') {
    $chequeBean = $cheque->c_busca_cheque_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
    $html .= '<tr>
                    <td colspan="11" align="left"><b>Tipo Pagamento.:  </b>' . $confpagBean->getPag_tipo_pagamento() . ' - CHEQUE' . '</td>
               </tr>';
    $html .= '<tr>
                    <td colspan="11" align="left"><b>Valor Cheque.: </b> ' . $chequeBean->getChq_valorcheque() . '</td>
              </tr>';

    $html .= '<tr>
                    <td colspan="11" align="left"><b>Numero Cheque.: </b> ' . $chequeBean->getChq_numerocheque() . '<b> Banco.:</b> ' . strtolower($chequeBean->getChq_nomebanco()) . ' </td>
              </tr>';
}


$html .= '<tr>
                    <td colspan="11" align="left"><b>Observação.: </b>  ' . strtolower($vendaCBean->getVendac_observacao()) . '</td>
                </tr>

                </thead>
            </table>';


$html .= '</br>';
$html .= '</br>';

$html .= '<table class="tabela" cellspacing="2" cellpadding="2">';
$html .= '<thead>
                <tr>
                <th align=center class="titulos">Item</th>
                <th align=center class="titulos">CodProd</th>
                <th align=left class="titulos">Descrição do Produto</th>
                <th align=left class="titulos">Quant.</th>
                <th align=left class="titulos">Valor Unit.</th>
                <th align=right class="titulos">Total</th>
                </tr>
                </thead>';
$html .= '<tbody>';

$vendaDBean = $vendaC->DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $vendaCBean->getVendac_chave());


$tot = 0;
foreach ($vendaDBean as $itens_venda) {
    $html .= '<tr>';
    $html .= '<td align=center class="linhas_itens">' . $itens_venda->getVendad_nro_item() . '</td>';
    $html .= '<td align=center class="linhas_itens">' . $itens_venda->getVendad_codigo_produto() . '</td>';
    $html .= '<td align=left class="linhas_itens"> ' . $itens_venda->getVendad_descricao_produto() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $itens_venda->getVendad_quantidade() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . number_format($itens_venda->getVendad_precovenda(), 2, ',', '.') . '</td>';
    $html .= '<td align=right class="linhas_itens">' . number_format($itens_venda->getVendad_total(), 2, ',', '.') . '</td>';
    $html .= '</tr>';
    $tot += $itens_venda->getVendad_total();
}

$html .= '<tr>';
$html .= '<td align=right colspan="5" class="subtotal">Total</td>';
$html .= '<td align=right class="subtotal">' . number_format($tot, 2, ',', '.') . '</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';


$recBean = $receber->c_buscar_todas_contas_receber_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);


if ($confpagBean->getPag_tipo_pagamento() == 'QUINZENAL' || $confpagBean->getPag_tipo_pagamento() == 'MENSAL' || $confpagBean->getPag_tipo_pagamento() == 'SEMANAL') {

    $html .= '<p style="border-style: solid;border-bottom-width: 1px;border-top-width: 0;      border-right-width: 0;border-left-width: 0; width:100%" ></p>';
    $total = 0;
    $pagas = 0;
    $parcelas_rec = 0;
    foreach ($recBean as $parcela) {

        if ($parcela->getRec_num_parcela() < 10) {

            $par = '0' . $parcela->getRec_num_parcela();

            $html .= '<span class="parcelas"> Parc ' . $par . ' |  Vencimento ' . Util::format_DD_MM_AAAA($parcela->getRec_datavencimento()) . ' | Vlr Receber ' . $parcela->getRec_valorreceber() . ' |  Vlr Pago ' . $parcela->getRec_valor_pago() . '  <br/>';
        } else {
            $html .= '<span class="parcelas"> Parc ' . $parcela->getRec_num_parcela() . ' |  Vencimento ' . Util::format_DD_MM_AAAA($parcela->getRec_datavencimento()) . ' | Vlr Receber ' . $parcela->getRec_valorreceber() . ' |  Vlr Pago ' . $parcela->getRec_valor_pago() . '  <br/>';
        }

        $total = $total + $parcela->getRec_valorreceber();
        $pagas = $pagas + $parcela->getRec_valor_pago();
    }

    $parcelas_rec = $total - $pagas;

    $html .= '<td  align=left class="totalParcelas"> Valor total das parcelas R$ ' . number_format($parcelas_rec, 2, '.', '') . '</td> <br/>';
}


$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();

