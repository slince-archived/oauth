<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Token\TokenInterface;

interface ServiceInterface
{
    function setCertificate();
    
    function getCertificate();
    
    function getAuthorizeUrl();
    
    function getBaseAuthorizeUri();
    
    function getBaseTokenUri();
    
    function getRequestMethod();
    
    function getBaseUri();
    
    function getFullUrl($path);
    
    function request($path, $params = []);
    
    function refreshToken(TokenInterface $token = null);
    
    protected function _retrieveTokenParamFromResponse($body, TokenInterface $token);
}