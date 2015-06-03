<?php
namespace Slince\OAuth\Service;

class Baidu extends AbstractService
{

    function getBaseAuthorizeUrl()
    {
        return 'http://openapi.baidu.com/oauth/2.0/authorize';
    }
    
    function getBaseTokenUrl()
    {
        return 'https://openapi.baidu.com/oauth/2.0/token';
    }
    
    function getRequestMethod()
    {
        return HttpMethod::REQUEST_GET;
    }
    
    protected function _createTokenFromResponse($body)
    {
        $data = json_decode($body, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            $this->_token->setAccessToken($data['access_token']);
            $this->_token->setRefreshToken($data['refresh_token']);
            $this->_token->setExpireTime($data['expires_in']);
            return $this->_token;
        } else {
            
        }
    }
    
}