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

var_dump($result);
