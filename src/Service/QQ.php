<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Service;

use Slince\OAuth\Exception\OAuthException;
use Slince\OAuth\Token\TokenInterface;
use Slince\OAuth\HttpMethod;

class QQ extends AbstractService
{

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseUri()
     */
    function getBaseUri()
    {
        return 'https://graph.qq.com/';
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseAuthorizeUri()
     */
    function getBaseAuthorizeUri()
    {
        return 'https://graph.qq.com/oauth2.0/authorize';
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getBaseTokenUri()
     */
    function getBaseTokenUri()
    {
        return 'https://graph.qq.com/oauth2.0/token';
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
     * @see \Slince\OAuth\Service\AbstractService::getAuthorizeUrl()
     */
    function getAuthorizeUrl($extraParams = [])
    {
        if (! isset($extraParams['state'])) {
            throw new OAuthException("You must provide 'state' parameter in 'extraParams'");
        }
        return parent::getAuthorizeUrl($extraParams);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\AbstractService::retrieveTokenFromResponse()
     */
    function retrieveTokenFromResponse($body, TokenInterface $token)
    {
        parse_str($body, $data);
        if (! empty($data) && ! isset($data['error'])) {
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