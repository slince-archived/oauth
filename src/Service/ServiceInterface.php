<?php
namespace Slince\OAuth\Service;

interface ServiceInterface
{
    function setCertificate();
    
    function getCertificate();
    
    function getAuthorizeUrl();
    
    function request($url);
    
    function refreshToken();
    
    function getBaseAuthorizeUrl();
    
    function getBaseTokenUrl();
    
    function getRequestMethod();
    
    protected function _createTokenFromResponse($body);
}