<?php
include __DIR__ . '/vendor/autoload.php';

use Slince\OAuth\Certificate\Certificate;
use Slince\OAuth\ServiceFactory;
use Slince\OAuth\Token\Token;

$certificate = new Certificate(
    'XP7GUBfoXMiGjYghCZyatKyF', 
    'qsgDdmwAuo2Pvag0UwpFdXOGGXXOQYTF',
    'http://work.slince.com/oauth'
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
}
