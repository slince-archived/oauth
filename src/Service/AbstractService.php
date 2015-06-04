<?php
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
    
    protected $_scopes = [];
    
    function __construct(CertificateInterface $certificate, TokenInterface $token, $scopes = [])
    {
        $this->_certificate = $certificate;
        $this->_token = $token;
        $this->_scopes = $scopes;
    }
    
    function setCertificate(CertificateInterface $certificate)
    {
        $this->_certificate = $certificate;
    }
    
    function getCertificate()
    {
        return $this->_certificate;
    }
    
    function setToken(TokenInterface $token)
    {
        $this->_token = $token;
    }
    
    function getToken()
    {
        return $this->_token;
    }
    
    /**
     * 获取授权地址
     * @param array $additionalParams
     * @return string
     */
    function getAuthorizeUrl($additionalParams = [])
    {
        $requestParams = [
            'response_type' => 'code',
            'client_id' => $this->_certificate->getClientId(),
            'redirect_uri' => $this->_certificate->getCallbackUrl(),
        ];
        if (! empty($this->_scopes)) {
            $requestParams['scope'] = implode(' ', $this->_scopes);
        }
        $params = array_merge($requestParams, $additionalParams);
        return $this->getBaseAuthorizeUri() . '?' . http_build_query($params);
    }
    
    function requestToken($code)
    {
        $requestParams = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->_certificate->getClientId(),
            'client_secret' => $this->_certificate->getClientSecret(),
            'redirect_uri' => $this->_certificate->getCallbackUrl(),
            'code' => $code
        ];
        if ($this->getRequestMethod() == HttpMethod::REQUEST_GET) {
            $options = [
                'query' => $requestParams,
                'verify' => false
            ];
        } else {
            $options = [
                'json' => $requestParams,
                'verify' => false
            ];
        }
        $body = RequestFactory::create($this->getBaseTokenUri(), $options, $this->getRequestMethod());
        $this->retrieveTokenFromResponse($body, $this->_token);
        return $this->_token;
    }
    
    function request($path, $params = [])
    {
        if ($this->_token->isExpired()) {
            throw new ExpiredTokenException();
        }
        $requestParams = array_merge([
            'access_token' => $this->_token->getAccessToken()
        ], $params);
        $body = RequestFactory::create($this->getFullUrl($path), $requestParams, $this->getRequestMethod());
        return $this->_parseResponse($body);
    }
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
        if ($this->getRequestMethod() == HttpMethod::REQUEST_GET) {
            $options = [
                'query' => $requestParams,
                'verify' => false
            ];
        } else {
            $options = [
                'json' => $requestParams,
                'verify' => false
            ];
        }
        $body = RequestFactory::create($this->getBaseTokenUri(), $options, $this->getRequestMethod());
        return $this->retrieveTokenFromResponse($body, $token);
    }
    
    function getFullUrl($path)
    {
        if (! empty($path) && $path{0} == '/') {
            $url = $this->getHostFromBaseUri() . $path;
        } else {
            $url = $this->getBaseUri() . $path;
        }
        return $url;
    }
    function getHostFromBaseUri()
    {
        return parse_url($this->getBaseUri(), PHP_URL_HOST);
    }
}