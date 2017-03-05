<?php

/**
 * Include PRReviews Class
 */
require_once __DIR__ . '/common/PRReview.php';
require_once __DIR__ . '/common/PrepareReview.php';

/**
 * @usage :
 *
 *  php github-review-linting.php 696  dd4c88604ac52485e329efc0319d96c11ca47978  693  'COMMENT'
 *
 *  pull request number :  The PR number which is to be built : 696\
 *  github token :  used to authenticate to github api e.g: dd4c88604ac52485e329efc0319d96c11ca47978
 *  teamcity build number:  teamcity build number to be able to link it to specific build. e.g: 693
 *  PR Event : APPROVE, REQUEST_CHANGES, or COMMENT, by default COMMENT
 *
 */
$contents = null;
try {

    // 'a96fb816babd7f679eda671c21de0fa47380a97e'
    $token       = 'sdfsdfsdfdsfsdfsdfdsfdsfdsfds';

    // prepare body text for linting
    // prepare PRReviews Objects with data
    $reviewPR = (new PRReviews())
        ->setApiToken( $token )
    ;
    // Send review request
    $response = $reviewPR
        ->getUsersInfos("azzeddinefaik");
    json_decode($response->getBody()->getContents());
    echo $response->getBody()->getContents();

} catch ( Exception $e ) {
    echo $e->getMessage();
    exit($e->getMessage());
}

if ($response) {
    $contents =
        "X-RateLimit-Limit: " . $response->getHeaders()["X-RateLimit-Limit"]["0"] . PHP_EOL .
        "X-RateLimit-Remaining: " . $response->getHeaders()["X-RateLimit-Remaining"]["0"] . PHP_EOL .
        "X-RateLimit-Reset: " . $response->getHeaders()["X-RateLimit-Reset"]["0"] . PHP_EOL .
        "body : " . PHP_EOL . $response->getBody()->getContents();
    echo $contents;
}
