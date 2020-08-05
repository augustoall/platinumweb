<?php

// este arquivo atualiza o codigo do cliente na venda e nas demais tabelas 
// quando o cliente foi cadastrado offline no android.
// tabelas afetadas : vendac ,cheque

require_once '../../includes/load__class__file_path_2.php';

$cliente = new ClientesInstance();
$clienteBean = new ClientesBean();
$vendaC = new VendaInstance();
$cheque = new ChequesInstance();
$receber = new ReceberInstance();
$ID_CPF_EMPRESA = (isset($_POST["ID_CPF_EMPRESA"])) ? $_POST["ID_CPF_EMPRESA"] : ((isset($_GET["ID_CPF_EMPRESA"])) ? $_GET["ID_CPF_EMPRESA"] : 0);
$clienteBean = $cliente->c_busca_cliente_gravado_android_offline($ID_CPF_EMPRESA);

foreach ($clienteBean as $cli) {

    //update codigo do cliente na venda
    $vendaC->c_atualiza_codigo_cliente_offline_vendac($cli->getCli_codigo(), $cli->getCli_chave(), $ID_CPF_EMPRESA);

    //update codigo do cliente receber
    $receber->c_atualiza_codigo_cliente_offline_receber($ID_CPF_EMPRESA, $cli->getCli_codigo(), $cli->getCli_chave());

    //update codigo do cliente cheque
    $cheque->c_atualiza_codigo_cliente_offline_cheque($ID_CPF_EMPRESA, $cli->getCli_codigo(), $cli->getCli_chave());

    // apaga a chave do cliente cadastrado offline
    $cliente->c_altera_cliente_cadastrado_offline($cli->getCli_codigo(), $ID_CPF_EMPRESA);
}

echo 'Registros Atualizados';


