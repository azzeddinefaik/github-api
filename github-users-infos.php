<?php

/**
 * Include xk Class
 */
require_once __DIR__ . '/common/GithubApi.php';

/**
 * @usage :
 */
$contents = null;
try {

    $token       = '00699542bd87f110ef4e65bd08df61f6c158ddd7';

    // prepare  Objects with data
    $githubClient = (new GithubApi())
        ->setApiToken( $token )
    ;
    // Send  request
    $response = $githubClient
        ->getUsersInfos("azzeddinefaik");
    $jsonData = json_decode($response->getBody()->getContents());

    echo "[+] Usename           : " .  $jsonData->login .PHP_EOL;
    echo "[+] URL               : " .  $jsonData->html_url .PHP_EOL;
    echo "[+] No public repos   : " .  $jsonData->public_repos .PHP_EOL;
    echo "[+] Email             : " .  $jsonData->email .PHP_EOL;
    echo "[+] Company           : " .  $jsonData->company .PHP_EOL;

} catch ( Exception $e ) {
    echo $e->getMessage();
    exit($e->getMessage());
}
