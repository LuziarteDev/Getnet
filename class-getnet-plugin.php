<?php
/**
 * Arquivo para integração do gateway de pagamento Getnet
 */

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
        'id' => '',
        'secret' => '',
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
     * "Debug and Die", função para Debug de forma simples;
     *
     * @return mix
     */
    public function dd($data)
    {
        return die(var_dump($data));
    }
}
