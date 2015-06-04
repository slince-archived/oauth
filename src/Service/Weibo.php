<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Exception\OAuthException;
use Slince\OAuth\Token\TokenInterface;
use Slince\OAuth\HttpMethod;

class Weibo extends AbstractService
{
    function getBaseUri()
    {
        return 'https://openapi.baidu.com/rest/2.0/';
    }
    
    function getBaseAuthorizeUri()
    {
        return 'https://api.weibo.com/oauth2/authorize';
    }
    
    function getBaseTokenUri()
    {
        return 'https://api.weibo.com/oauth2/access_token';
    }
    
    function getRequestMethod()
    {
        return HttpMethod::REQUEST_POST;
    }
    
    protected function _refreshTokenFromResponse($body, TokenInterface $token)
    {
        $data = json_decode($body, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            $token->setAccessToken($data['access_token']);
            $token->setRefreshToken($data['refresh_token']);
            $token->setExpireTime($data['expires_in']);
            return $token;
        } else {
            throw new OAuthException('Error response body');
        }
    }
}