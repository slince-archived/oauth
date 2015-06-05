<?php
include __DIR__ . '/init.php';

use Slince\OAuth\Certificate\Certificate;
use Slince\OAuth\ServiceFactory;
use Slince\OAuth\Token\Token;

$certificate = new Certificate(
    $config['weibo']['clientId'], 
    $config['weibo']['clientSecret'], 
    'http://work.slince.com/oauth/demo/weibo.php'
);
$token = new Token();
$weibo = ServiceFactory::get('weibo', $certificate, $token);
if (empty($_GET['code'])) {
    echo $location = $weibo->getAuthorizeUrl();
    header("location: {$location}");
} else {
    $token = $weibo->requestToken($_GET['code']);
    echo $token->getAccessToken();
    /**
     * 微博不支持获取refresh token，所以无法进行token刷新操作
     * $token = $weibo->refreshToken($token);
     * echo $token->getAccessToken();
     */
    $user = $weibo->request('users/show.json', [
        'uid' => $token->getExtraParam('uid')
    ]);
    print_r($user);
}
