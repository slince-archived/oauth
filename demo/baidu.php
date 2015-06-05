<?php
include __DIR__ . '/init.php';

use Slince\OAuth\Certificate\Certificate;
use Slince\OAuth\ServiceFactory;
use Slince\OAuth\Token\Token;

$certificate = new Certificate(
    $config['baidu']['clientId'], 
    $config['baidu']['clientSecret'], 
    'http://work.slince.com/oauth/demo/baidu.php'
);
$token = new Token();
$baidu = ServiceFactory::get('baidu', $certificate, $token);
if (empty($_GET['code'])) {
    echo $location = $baidu->getAuthorizeUrl();
    header("location: {$location}");
} else {
    $token = $baidu->requestToken($_GET['code']);
    echo $token->getAccessToken();
    $token = $baidu->refreshToken($token);
    echo $token->getAccessToken();
    $user = $baidu->request('passport/users/getInfo');
    print_r($user);
}
