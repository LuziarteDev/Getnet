<?php
/**
 * Classe para realizar funções e integração do Getnet
 */
class Getnet
{
    /**
     * Dados de acesso, dentro do array deverá ser passado o clientId e o ClientSecret
     *
     * @var array
     */
    protected $clientData = array(
        'id'        => '',
        'secret'    => '',
        'seller_id' => '',
    );

    /**
     * URL da api do Getnet
     *
     * @var string
     */
    public $apiUri = 'https://api-sandbox.getnet.com.br';

    /**
     * Construtor
     */
    public function __construct($clientData)
    {
        $this->clientData = $clientData;
    }

    /**
     * Retorna o token de autenticação
     *
     * @param [Array] $clientData
     * @return Array, Retorna os dados do cliente em caso de successo
     */
    public function getToken()
    {
        //Cript para base64 exigido pela API
        $clientAuth = 'Basic ' . base64_encode($this->clientData['id'] . ':' . $this->clientData['secret']);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUri . "/auth/oauth/v2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "scope=oob&grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "authorization:$clientAuth",
                "content-type: application/x-www-form-urlencoded",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return ($err) ? "Request error #:" . $err : json_decode($response);
    }

    /**
     * Função responsável por gerar o script do iframe de pagamento
     *
     * @param [array] $data
     * @return string
     */
    public function iframeGenerator($data)
    {
        //<script id="getnet-loader-script" src="https://checkout-sandbox.getnet.com.br/loader.js" data-getnet-sellerid="055b2577-4be6-4c1b-af6b-f77d44b672f2" data-getnet-token="Bearer 478a2a27-87cb-403f-95a5-abf8eb2db51b" data-getnet-payment-methods-disabled="[]" data-getnet-amount="123000.45" data-getnet-customerid="12345" data-getnet-orderid="12345" data-getnet-button-class="pay-button-getnet" data-getnet-customer-first-name="João" data-getnet-customer-last-name="da Silva" data-getnet-customer-document-type="CPF" data-getnet-customer-document-number="82916868070" data-getnet-customer-email="teste@teste.com" data-getnet-customer-address-street="Av. Nações Unidas" data-getnet-customer-address-street-number="1" data-getnet-customer-address-neighborhood="Brooklin" data-getnet-customer-address-city="São Paulo" data-getnet-customer-address-state="SP" data-getnet-customer-address-zipcode="04578907" data-getnet-customer-country="Brasil" data-getnet-shipping-address="[]" data-getnet-items="[{"name":"","description":"","value":0,"quantity":0,"sku":""}]"></script>
        return $script;
    }

    /**
     * "Debug and Die", função para Debug de forma simples;
     *
     * @return mix
     */
    public function dd($data)
    {
        return die(var_dump($data));
    }
}
