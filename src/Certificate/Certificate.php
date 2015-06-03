<?php
namespace Slince\OAuth\Certificate;

class Certificate
{

    protected $_clientId;

    protected $_clientSecret;

    function __construct($clientId, $clientSecret)
    {
        $this->_clientId = $clientId;
        $this->_clientSecret = $clientSecret;
    }

    function getClientId()
    {
        return $this->_clientId;
    }

    function setClientId($clientId)
    {
        $this->_clientId = $clientId;
    }

    function getClientSecret()
    {
        return $this->_clientSecret;
    }
}