<?php
namespace Slince\OAuth\Certificate;

interface CertificateInterface
{

    function setClientId($clientId);

    function getClientId();
    
    function setClientSecret($clientSecret);

    function getClientSecret();

    function setCallbackUrl($callbackUrl);

    function getCallbackUrl();
}