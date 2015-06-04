<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Token\TokenInterface;

interface ServiceInterface
{
    function setCertificate(CertificateInterface $certificate);
    
    function getCertificate();
    
    function setToken(TokenInterface $token);
    
    function getToken();
    
    function getAuthorizeUrl();
    
    function getBaseAuthorizeUri();
    
    function getBaseTokenUri();
    
    function getRequestMethod();
    
    function getBaseUri();
    
    function getFullUrl($path);
    
    function request($path, $params = []);
    /**
     * 根据授权码获取token
     * @param string $code
     * @return TokenInterface
     */
    function requestToken($code);
    
    function refreshToken(TokenInterface $token = null);
    
    function retrieveTokenFromResponse($body, TokenInterface $token);
}