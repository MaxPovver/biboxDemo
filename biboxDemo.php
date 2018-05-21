<?php
define('API_URL', 'https://api.bibox.com/v1/');
define('PAGE_SIZE', 50); // max page size
define('USUAL_ACCOUNT', 0);
define('MARGIN_ACCOUNT', 1);

$apiKeys['public'] = '';
$apiKeys['secret'] = '';

$ch = getCh('orderpending', 'orderHistoryList', [ "account_type" => 0, "page" => 1, "size" => PAGE_SIZE], $apiKeys);
echo curl_exec($ch);
curl_close($ch);

function getCh($command, $subCommand, $params, $apiKeys) {
    $publicKey = $apiKeys['public'];
    $secretKey = $apiKeys['secret'];
    $commands = json_encode([
        ["cmd" => $command . "/".$subCommand, "body" => $params]
    ]); // NOTE Its __array__ of ["cmd"=>...] objects, not just one cmd object. you must pass array even when you use only one command or it won't work
    $url = API_URL . $command;

    $signature = hash_hmac('md5', $commands, $secretKey); // Hashing it

    $ch = curl_init($url);
    if (true) {// make false on prod or remove
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,['Content-Type: application/json',]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["cmds" => $commands, 'apikey' => $publicKey, 'sign' => $signature]));

    return $ch;
}
