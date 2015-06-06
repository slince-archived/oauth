<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Service;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Token\TokenInterface;
use Slince\OAuth\Exception\ExpiredTokenException;
use Slince\OAuth\RequestFactory;
use Slince\OAuth\HttpMethod;

abstract class AbstractService implements ServiceInterface
{

    /**
     * 身份证书
     *
     * @var CertificateInterface
     */
    protected $_certificate;

    /**
     * token
     *
     * @var TokenInterface
     */
    protected $_token;

    /**
     * 权限
     */
    protected $_scopes = [];

    function __construct(CertificateInterface $certificate, TokenInterface $token, $scopes = [])
    {
        $this->_certificate = $certificate;
        $this->_token = $token;
        $this->_scopes = $scopes;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::setCertificate()
     */
    function setCertificate(CertificateInterface $certificate)
    {
        $this->_certificate = $certificate;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getCertificate()
     */
    function getCertificate()
    {
        return $this->_certificate;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::setToken()
     */
    function setToken(TokenInterface $token)
    {
        $this->_token = $token;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getToken()
     */
    function getToken()
    {
        return $this->_token;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getAuthorizeUrl()
     */
    function getAuthorizeUrl($extraParams = [])
    {
        $requestParams = [
            'response_type' => 'code',
            'client_id' => $this->_certificate->getClientId(),
            'redirect_uri' => $this->_certificate->getCallbackUrl()
        ];
        if (! empty($this->_scopes)) {
            $requestParams['scope'] = implode(' ', $this->_scopes);
        }
        $params = array_merge($requestParams, $extraParams);
        return $this->getBaseAuthorizeUri() . '?' . http_build_query($params);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::requestToken()
     */
    function requestToken($code)
    {
        $requestParams = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->_certificate->getClientId(),
            'client_secret' => $this->_certificate->getClientSecret(),
            'redirect_uri' => $this->_certificate->getCallbackUrl(),
            'code' => $code
        ];
        $body = RequestFactory::create($this->getBaseTokenUri(), $this->_buildRequestParam($requestParams, $this->getAuthorizeMethod()), $this->getAuthorizeMethod());
        $this->retrieveTokenFromResponse($body, $this->_token);
        return $this->_token;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::request()
     */
    function request($path, $params = [])
    {
        if ($this->_token->isExpired()) {
            throw new ExpiredTokenException();
        }
        $requestParams = array_merge([
            'access_token' => $this->_token->getAccessToken()
        ], $params);
        $body = RequestFactory::create($this->getFullUrl($path), $this->_buildRequestParam($requestParams, $this->getRequestMethod()), $this->getRequestMethod());
        return $this->_parseResponse($body);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::refreshToken()
     */
    function refreshToken(TokenInterface $token = null)
    {
        if (is_null($token)) {
            $token = $this->_token;
        }
        $requestParams = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->_certificate->getClientId(),
            'client_secret' => $this->_certificate->getClientSecret(),
            'refresh_token' => $token->getRefreshToken()
        ];
        $body = RequestFactory::create($this->getBaseTokenUri(), $this->_buildRequestParam($requestParams, $this->getAuthorizeMethod()), $this->getAuthorizeMethod());
        return $this->retrieveTokenFromResponse($body, $token);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Service\ServiceInterface::getFullUrl()
     */
    function getFullUrl($path)
    {
        if (! empty($path) && $path{0} == '/') {
            $url = $this->_getHostFromBaseUri() . $path;
        } else {
            $url = $this->getBaseUri() . $path;
        }
        return $url;
    }

    /**
     * 生成请求参数
     *
     * @param array $param            
     * @param string $method            
     * @return array
     */
    protected function _buildRequestParam($param, $method)
    {
        $options = [];
        switch ($method) {
            case HttpMethod::REQUEST_GET:
                $options = [
                    'query' => $param
                ];
                break;
            case HttpMethod::REQUEST_POST:
                $options = [
                    'body' => $param
                ];
                break;
        }
        return $options;
    }

    /**
     * 从api基本地址中获取域名
     *
     * @return mixed
     */
    protected function _getHostFromBaseUri()
    {
        return parse_url($this->getBaseUri(), PHP_URL_HOST);
    }
    
    /**
     * 解析api返回结果
     *
     * @param string $body
     */
    abstract function _parseResponse($body);
}