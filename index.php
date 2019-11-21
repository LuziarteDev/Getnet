<?php //Silence is golden
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once 'class-getnet-plugin.php';

$getnet = new Getnet(
    array(
        'id' => 'd9a34c65-4e5a-4abf-9055-149a23517293',
        'secret' => 'b36fbf4b-31c9-443b-912a-1853093fec7a',
        'seller_id' => '055b2577-4be6-4c1b-af6b-f77d44b672f2',
    )
);

$result = $getnet->getToken();
$test = base64_encode('<script id="getnet-loader-script" src="https://checkout-sandbox.getnet.com.br/loader.js" data-getnet-sellerid="055b2577-4be6-4c1b-af6b-f77d44b672f2" data-getnet-token="Bearer 478a2a27-87cb-403f-95a5-abf8eb2db51b" data-getnet-payment-methods-disabled="[]" data-getnet-amount="123000.45" data-getnet-customerid="12345" data-getnet-orderid="12345" data-getnet-button-class="pay-button-getnet" data-getnet-customer-first-name="João" data-getnet-customer-last-name="da Silva" data-getnet-customer-document-type="CPF" data-getnet-customer-document-number="82916868070" data-getnet-customer-email="teste@teste.com" data-getnet-customer-address-street="Av. Nações Unidas" data-getnet-customer-address-street-number="1" data-getnet-customer-address-neighborhood="Brooklin" data-getnet-customer-address-city="São Paulo" data-getnet-customer-address-state="SP" data-getnet-customer-address-zipcode="04578907" data-getnet-customer-country="Brasil" data-getnet-shipping-address="[]" data-getnet-items="[{"name":"","description":"","value":0,"quantity":0,"sku":""}]data-getnet-recurrency="true""></script>');


echo('<button class="pay-button-getnet">Realizar pagamento</button>');

echo( base64_decode( $test ) );