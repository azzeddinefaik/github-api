<?php

/**
 * Include PRReviews Class
 */
require_once __DIR__ . '/common/PRReview.php';

/**
 * @usage :
 */
$contents = null;
try {

    $token       = '5ed1930b05affsfsdfsdfb000766f9df8a41c4384d12dd';

    // prepare PRReviews Objects with data
    $reviewPR = (new PRReviews())
        ->setApiToken( $token )
    ;
    // Send review request
    $response = $reviewPR
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
