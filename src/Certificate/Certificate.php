<?php
namespace Slince\OAuth\Certificate;

class Certificate implements CertificateInterface
{

    protected $_clientId;

    protected $_clientSecret;

    protected $_callbackUrl;

    function __construct($clientId, $clientSecret, $callbackUrl)
    {
        $this->_clientId = $clientId;
        $this->_clientSecret = $clientSecret;
        $this->_callbackUrl = $callbackUrl;
    }

    function getClientId()
    {
        return $this->_clientId;
    }

    function setClientId($clientId)
    {
        $this->_clientId = $clientId;
    }

    function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
    }

    function getClientSecret()
    {
        return $this->_clientSecret;
    }

    function setCallbackUrl($callbackUrl)
    {
        $this->_callbackUrl = $callbackUrl;
    }

    function getCallbackUrl()
    {
        return $this->_callbackUrl;
    }
}