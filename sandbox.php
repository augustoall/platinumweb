<?php

require_once './view/Assets/libs/vendor/autoload.php';

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("CMDV")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("CMDV")->setRelease("1.0.0");


$pagamentoPagSeguro = new \PagSeguro\Domains\Requests\Payment();

$pagamentoPagSeguro->addItems()->withParameters(
    '0001',
    'Notebook prata',
    2,
    130.00
);


$pagamentoPagSeguro->setCurrency("BRL");

$pagamentoPagSeguro->setExtraAmount(49.9);

$pagamentoPagSeguro->setReference("LIC30");

$pagamentoPagSeguro->setRedirectUrl("www.centralmetadevendas.com.br");

// Set your customer information.
$pagamentoPagSeguro->setSender()->setName('Pauloceami');
$pagamentoPagSeguro->setSender()->setEmail('c82064083760666298750@sandbox.pagseguro.com.br');
$pagamentoPagSeguro->setSender()->setPhone()->withParameters(
    16,
    993584313
);
$pagamentoPagSeguro->setSender()->setDocument()->withParameters(
    'CPF',
    '22124254812'
);

$pagamentoPagSeguro->setShipping()->setAddress()->withParameters(
    'Av. Brig. Faria Lima',
    '1384',
    'Jardim Paulistano',
    '01452002',
    'São Paulo',
    'SP',
    'BRA',
    'apto. 114'
);
$pagamentoPagSeguro->setShipping()->setCost()->withParameters(20.00);
$pagamentoPagSeguro->setShipping()->setType()->withParameters(\PagSeguro\Enum\Shipping\Type::SEDEX);

//Add metadata items
$pagamentoPagSeguro->addMetadata()->withParameters('PASSENGER_CPF', '22124254812');
$pagamentoPagSeguro->addMetadata()->withParameters('GAME_NAME', 'DOTA');
$pagamentoPagSeguro->addMetadata()->withParameters('PASSENGER_PASSPORT', '23456', 1);

//Add items by parameter
//On index, you have to pass in parameter: total items plus one.
$pagamentoPagSeguro->addParameter()->withParameters('itemId', '0003')->index(3);
$pagamentoPagSeguro->addParameter()->withParameters('itemDescription', 'Notebook Amarelo')->index(3);
$pagamentoPagSeguro->addParameter()->withParameters('itemQuantity', '1')->index(3);
$pagamentoPagSeguro->addParameter()->withParameters('itemAmount', '200.00')->index(3);

//Add items by parameter using an array
$pagamentoPagSeguro->addParameter()->withArray(['notificationURL', 'http://www.lojamodelo.com.br/nofitication']);

$pagamentoPagSeguro->setRedirectUrl("www.centralmetadevendas.com.br");
$pagamentoPagSeguro->setNotificationUrl("www.centralmetadevendas.com.br/nofitication.php");

//Add discount
$pagamentoPagSeguro->addPaymentMethod()->withParameters(
    PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
    PagSeguro\Enum\PaymentMethod\Config\Keys::DISCOUNT_PERCENT,
    10.00 // (float) Percent
);

//Add installments with no interest
$pagamentoPagSeguro->addPaymentMethod()->withParameters(
    PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
    PagSeguro\Enum\PaymentMethod\Config\Keys::MAX_INSTALLMENTS_NO_INTEREST,
    2 // (int) qty of installment
);

//Add a limit for installment
$pagamentoPagSeguro->addPaymentMethod()->withParameters(
    PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
    PagSeguro\Enum\PaymentMethod\Config\Keys::MAX_INSTALLMENTS_LIMIT,
    6 // (int) qty of installment
);

// Add a group and/or payment methods name
$pagamentoPagSeguro->acceptPaymentMethod()->groups(
    \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
    \PagSeguro\Enum\PaymentMethod\Group::BALANCE
);

//$pagamentoPagSeguro->acceptPaymentMethod()->name(\PagSeguro\Enum\PaymentMethod\Name::DEBITO_ITAU);
// Remove a group and/or payment methods name
//$pagamentoPagSeguro->excludePaymentMethod()->group(\PagSeguro\Enum\PaymentMethod\Group::BOLETO);

$pagamentoPagSeguro->acceptPaymentMethod()->name(\PagSeguro\Enum\PaymentMethod\Name::AVISTA);

try {

    /**
     * @todo For checkout with application use:
     * \PagSeguro\Configuration\Configure::getApplicationCredentials()
     *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BF50D")
     */
    $result = $pagamentoPagSeguro->register(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

    echo "<h2>Criando requisi&ccedil;&atilde;o de pagamento</h2>"
        . "<p>URL do pagamento: <strong>$result</strong></p>"
        . "<p><a title=\"URL do pagamento\" href=\"$result\" target=\_blank\">Ir para URL do pagamento.</a></p>";
} catch (Exception $e) {
    die($e->getMessage());
}
