<?php

ob_start();
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!$_SESSION["usu_cpf"]) {
    header("Location:../index.php");
} else {

    require_once '../../includes/load__class__file_path_2.php';

    $permisao = new PermissoesInstance();
    $permissaoBean = new PermissoesBean();
    $permissaoBean = $permisao->C_buscarPermParaTabelaDe("vendac");

    $incluir = $permissaoBean->getPer_incluir();
    $alterar = $permissaoBean->getPer_alterar();

    $visualizar = $permissaoBean->getPer_visualizar();
    $excluir = $permissaoBean->getPer_excluir();
    $nivel = $permissaoBean->getPer_nivel();
    $ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

    $empresa_config = new EmpresaConfigInstance();
    $emp = new EmpresaConfigBean();
    $emp = $empresa_config->c_busca_empresa_config($ID_CPF_EMPRESA);


    $vendaC = new VendaInstance();
    $vendaCBean = new VendacBean();

    $vendac_chave = $_REQUEST["vendac_chave"];


    if ($nivel == "DIRETOR") {
        $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave_para_diretor($vendac_chave);
    }

    if ($nivel == "ADM") {
        $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
    }

    if ($nivel == "USER") {
        $vendaCBean = $vendaC->c_busca_vendac_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
    }

    /*
     * Gerar um arquivo .txt para imprimir na impressora Bematech MP-20 MI
     */

    $n_colunas = 40; // 40 colunas por linha

    /**
     * Adiciona a quantidade necessaria de espaços no inicio 
     * da string informada para deixa-la centralizada na tela
     * 
     * @global int $n_colunas Numero maximo de caracteres aceitos
     * @param string $info String a ser centralizada
     * @return string
     */
    function centraliza($info) {
        global $n_colunas;

        $aux = strlen($info);

        if ($aux < $n_colunas) {
            // calcula quantos espaços devem ser adicionados
            // antes da string para deixa-la centralizada
            $espacos = floor(($n_colunas - $aux) / 2);

            $espaco = '';
            for ($i = 0; $i < $espacos; $i++) {
                $espaco .= ' ';
            }

            // retorna a string com os espaços necessários para centraliza-la
            return $espaco . $info;
        } else {
            // se for maior ou igual ao número de colunas
            // retorna a string cortada com o número máximo de colunas.
            return substr($info, 0, $n_colunas);
        }
    }

    /**
     * Adiciona a quantidade de espaços informados na String
     * passada na possição informada.
     * 
     * Se a string informada for maior que a quantidade de posições
     * informada, então corta a string para ela ter a quantidade
     * de caracteres exata das posições.
     * 
     * @param string $string String a ter os espaços adicionados.
     * @param int $posicoes Qtde de posições da coluna
     * @param string $onde Onde será adicionar os espaços. I (inicio) ou F (final).
     * @return string
     */
    function addEspacos($string, $posicoes, $onde) {

        $aux = strlen($string);

        if ($aux >= $posicoes)
            return substr($string, 0, $posicoes);

        $dif = $posicoes - $aux;

        $espacos = '';

        for ($i = 0; $i < $dif; $i++) {
            $espacos .= ' ';
        }

        if ($onde === 'I')
            return $espacos . $string;
        else
            return $string . $espacos;
    }

    $txt_cabecalho = array();
    $txt_itens = array();
    $txt_valor_total = '';
    $txt_rodape = array();

    $txt_cabecalho[] = $emp->getEmp_nomefantasia() . ' - ' . $emp->getEmp_contato1();

    $txt_cabecalho[] = 'DEMONSTRATIVO DE COMPRA';

    $txt_cabecalho[] = ' '; // força pular uma linha entre o cabeçalho e os itens

    $txt_itens[] = array('Cod.', 'Produto', 'Env.', 'Qtd', 'V. UN', 'Total');

    $tot_itens = 0;

    $detalhes_venda = new VendadBean();
    $venda = new VendaInstance();

    if ($nivel == "ADM") {
        $detalhes_venda = $venda->DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
    }

    if ($nivel == "USER") {
        $detalhes_venda = $venda->DETALHESc_buscar_itens_da_venda_por_vendac_chave($ID_CPF_EMPRESA, $vendac_chave);
    }

    if ($nivel == "DIRETOR") {
        $detalhes_venda = $venda->c_buscar_itens_da_venda_por_vendac_chave_para_diretor($vendac_chave);
    }


    foreach ($detalhes_venda as $itens_venda) {

        $txt_itens[] = array($itens_venda->getVendad_codigo_produto(), strtolower($itens_venda->getVendad_descricao_produto()), '000', $itens_venda->getVendad_quantidade(), $itens_venda->getVendad_precovenda(), $itens_venda->getVendad_total());
        $tot_itens += $itens_venda->getVendad_total();
    }

    $aux_valor_total = 'Sub-total: ' . $tot_itens;

    // calcula o total de espaços que deve ser adicionado antes do "Sub-total" para alinhado a esquerda
    $total_espacos = $n_colunas - strlen($aux_valor_total);

    $espacos = '';

    for ($i = 0; $i < $total_espacos; $i++) {
        $espacos .= ' ';
    }

    $txt_valor_total = $espacos . $aux_valor_total;

    $txt_rodape[] = 'Cód. Cliente: ' . $vendaCBean->getVendac_cli_codigo();

    $txt_rodape[] = 'CPF/CNPJ: 999.999.999-99';

    $txt_rodape[] = $vendaCBean->getVendac_cli_nome();

    $txt_rodape[] = ' '; // força pular uma linha

    $txt_rodape[] = '________________________________________';

    $txt_rodape[] = '         Assinatura do Cliente          ';

    // centraliza todas as posições do array $txt_cabecalho
    $cabecalho = array_map("centraliza", $txt_cabecalho);

    /* para cada linha de item (array) existente no array $txt_itens,
     * adiciona cada posição da linha em um novo array $itens
     * fazendo a formatação dos espaçamentos entre cada coluna
     * da linha através da função "addEspacos"
     */
    foreach ($txt_itens as $item) {

        /*
         * Cod. => máximo de 5 colunas
         * Produto => máximo de 11 colunas
         * Env. => máximo de 6 colunas
         * Qtd => máximo de 4 colunas
         * V. UN => máximo de 7 colunas
         * Total => máximo de 7 colunas
         *
         * $itens[] = 'Cod. Produto      Env. Qtd  V. UN  Total'
         */

        $itens[] = addEspacos($item[0], 5, 'F')
                . addEspacos($item[1], 11, 'F')
                . addEspacos($item[2], 6, 'I')
                . addEspacos($item[3], 4, 'I')
                . addEspacos($item[4], 7, 'I')
                . addEspacos($item[5], 7, 'I')
        ;
    }

    /* concatena o cabelhaço, os itens, o sub-total e rodapé
     * adicionando uma quebra de linha "\r\n" ao final de cada
     * item dos arrays $cabecalho, $itens, $txt_rodape
     */
    $txt = implode("\r\n", $cabecalho)
            . "\r\n"
            . implode("\r\n", $itens)
            . "\r\n"
            . $txt_valor_total // Sub-total
            . "\r\n\r\n"
            . implode("\r\n", $txt_rodape);

    // caminho e nome onde o TXT será criado no servidor
    $file = 'venda_' . $vendaCBean->getVendac_cli_nome() . '_' . $vendaCBean->getVendac_chave() . '.txt';

    // cria o arquivo
    $_file = fopen($file, "w");
    fwrite($_file, $txt);
    fclose($_file);

    header("Pragma: public");
    // Força o header para salvar o arquivo
    header("Content-type: application/save");
    header("X-Download-Options: noopen "); // For IE8
    header("X-Content-Type-Options: nosniff"); // For IE8
    // Pré define o nome do arquivo
    header("Content-Disposition: attachment; filename=venda.txt");
    header("Expires: 0");
    header("Pragma: no-cache");

    // Lê o arquivo para download
    readfile($file);

    exit;
}   