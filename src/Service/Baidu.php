<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Service;

use Slince\OAuth\Exception\OAuthException;
use Slince\OAuth\Token\TokenInterface;
use Slince\OAuth\HttpMethod;

class Baidu extends AbstractService
{

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseUri()
     */
    function getBaseUri()
    {
        return 'https://openapi.baidu.com/rest/2.0/';
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseAuthorizeUri()
     */
    function getBaseAuthorizeUri()
    {
        return 'http://openapi.baidu.com/oauth/2.0/authorize';
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseTokenUri()
     */
    function getBaseTokenUri()
    {
        return 'https://openapi.baidu.com/oauth/2.0/token';
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::getRequestMethod()
     */
    function getRequestMethod()
    {
        return HttpMethod::REQUEST_GET;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::getAuthorizeMethod()
     */
    function getAuthorizeMethod()
    {
        return HttpMethod::REQUEST_GET;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\ServiceInterface::retrieveTokenFromResponse()
     */
    function retrieveTokenFromResponse($body, TokenInterface $token)
    {
        $data = json_decode($body, true);
        if (json_last_error() == JSON_ERROR_NONE && ! isset($data['error'])) {
            $token->setAccessToken($data['access_token']);
            $token->setRefreshToken($data['refresh_token']);
            $token->setExpireTime(time() + $data['expires_in']);
            return $token;
        }
        throw new OAuthException('Error response body');
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Service\AbstractService::_parseResponse()
     */
    protected function _parseResponse($body)
    {
        $data = json_decode($body, true);
        if (json_last_error() == JSON_ERROR_NONE && ! isset($data['error'])) {
            return $data;
        }
        throw new OAuthException('Error response body');
    }
}