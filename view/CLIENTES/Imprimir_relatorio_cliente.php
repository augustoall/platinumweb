<?php

ob_start();
require_once '../../includes/load__class__file_path_2.php';
if (!Util::verifica_sessao()) {
    header("location:../../sessao-expirada.php");
    exit();
}


$permisao = new PermissoesInstance();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("clientes");
$visualizar = $permissaoBean->getPer_visualizar();
$nivel = $permissaoBean->getPer_nivel();
if ($visualizar == "N") {
    echo file_get_contents('../sem-permissao-visualizar.php');
    exit();
}


include '../Assets/libs/mpdf60/mpdf.php';
define('_MPDF_URI', '../Assets/libs/mpdf60/');

$empresa_config = new EmpresaConfigInstance();
$empresa_configBean = new EmpresaConfigBean();
$logo = new LogomarcasInstance();
$logoBean = new LogomarcasBean();
$cliente = new ClientesInstance();
$clienteBean = new ClientesBean();
$mpdf = new mPDF();

$relatorio_de = (isset($_POST["rel"])) ? $_POST["rel"] : ((isset($_GET["rel"])) ? $_GET["rel"] : "");
$tipo_consulta = (isset($_POST["tipo_consulta"])) ? $_POST["tipo_consulta"] : ((isset($_GET["tipo_consulta"])) ? $_GET["tipo_consulta"] : "");

$log = new LogInstance();
$log->c_inserir_log('CLIENTES', 'IMPRESSAO DE RELATORIO CLIENTE' . '  /  NIVEL->> ' . $nivel, $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);

$logoBean = $logo->c_buscar_logomarca($_SESSION["ID_CPF_EMPRESA"]);
$empresa_configBean = $empresa_config->c_busca_empresa_config($_SESSION["ID_CPF_EMPRESA"]);

if (is_null($logoBean->getLgm_nomelogo())) {
    $img.='<img src="../LOGOMARCAS/img_logos/semfoto.jpg"  width="80px" heigth="80px"  />';
} else {
    $img.='<img src="../LOGOMARCAS/img_logos/' . $logoBean->getLgm_nomelogo() . '"  width="80px" heigth="80px"  />';
}

$cabecalho = ' *****  ' . $empresa_configBean->getEmp_nomefantasia() . ' ***** Emissão : {DATE d/m/y}  ****** RELATÓRIO DE CLIENTES  ******* {PAGENO} de {nbpg} paginas';



switch ($tipo_consulta) {

    case "filtrar_clientes_por_bairro";

        $clienteBean = $cliente->c_imprime_relatorio_clientes_por_bairro();
        $data .='<h4 style="text-align:center;"> RELATORIO DE CLIENTE POR ' . $relatorio_de . " EM " . strtoupper($_POST["cid_nome"]) . '      </h4>';
        break;

    case "filtrar_clientes_por_vendedor";
        $clienteBean = $cliente->c_imprime_relatorio_cliente_por_vendedor();
        $data .='<h4 style="text-align:center;"> RELATORIO DE CLIENTE POR ' . $relatorio_de . '    </h4>';
        break;


    case "filtrar_clientes_por_cidade";
        $clienteBean = $cliente->c_imprime_relatorio_cliente_por_cidade();
        $data .='<h4 style="text-align:center;"> RELATORIO DE CLIENTE POR "' . $relatorio_de . '" </h4>';
        break;
}

if (count($clienteBean) <= 0) {
    echo file_get_contents('../nenhum-registro-encontrado.php');
    exit();
}


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
                    <th align=left class="titulos">Cidade</th>
                        <th align=left class="titulos">Cod.</th>
                        <th align=left class="titulos">Nome</th>
                        <th align=left class="titulos">Fone</th>                        
                        <th align=left class="titulos">Bairro</th>
                        <th align=right class="titulos">End.</th>   
                        <th align=right class="titulos">CPF/CNPJ</th>     
                    </tr>
                </thead>';
$html .= '<tbody>';

foreach ($clienteBean as $cliente) {
    $html .= '<tr>';
    $html .= '<td align=left class="linhas_itens">' . $cliente->getCid_nome() . '..' . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $cliente->getCli_codigo() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $cliente->getCli_nome() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $cliente->getCli_contato1() . '</td>';
    $html .= '<td align=left class="linhas_itens">' . $cliente->getCli_bairro() . '</td>';
    $html .= '<td align=right class="linhas_itens">' . $cliente->getCli_endereco() . '</td>';
    $html .= '<td align=right class="linhas_itens">' . $cliente->getCli_cpfcnpj() . '</td>';
    $html .= '</tr>';}
$html .= '</tbody>';
$html .= '</table>';

$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../Assets/css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('../orcamentospdf/' . $orcBean["cli_nome"] . '_' . $orcBean["orc_id"] . '.pdf');
$mpdf->Output();
