<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Exception\OAuthException;
use Slince\OAuth\Token\TokenInterface;
use Slince\OAuth\HttpMethod;

class Baidu extends AbstractService
{

    function getBaseUri()
    {
        return 'https://openapi.baidu.com/rest/2.0/';
    }
    
    function getBaseAuthorizeUri()
    {
        return 'http://openapi.baidu.com/oauth/2.0/authorize';
    }
    
    function getBaseTokenUri()
    {
        return 'https://openapi.baidu.com/oauth/2.0/token';
    }
    
    function getRequestMethod()
    {
        return HttpMethod::REQUEST_GET;
    }
    
    function retrieveTokenFromResponse($body, TokenInterface $token)
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