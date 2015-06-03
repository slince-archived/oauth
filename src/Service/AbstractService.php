<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Token\TokenInterface;

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
    
    function __construct(CertificateInterface $certificate, TokenInterface $token, $scopse = [])
    {
        $this->_certificate = $certificate;
        $this->_token = $token;
        $this->_scopse = $scopse;
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
            $requestParams['scope'] = implode(' ', $this->_scopse);
        }
        $params = array_merge($requestParams, $additionalParams);
        return $this->getBaseAuthorizeUrl() . '?' . http_build_query($params);
    }
    
    function requestAccessToken($code)
    {
        $requestParams = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->_certificate->getClientId(),
            'client_secret' => $this->_certificate->getClientSecret(),
            'redirect_uri' => $this->_certificate->getCallbackUrl(),
            'code' => $code
        ];
        $body = RequestFactory::create($this->getBaseTokenUrl(), $requestParams, $this->getRequestMethod());
        $this->parseAccessTokenResponse($body);
        return $this->_token;
    }
    function refreshToken(TokenInterface $token = null)
    {
        
    }
    
}