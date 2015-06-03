<?php
namespace Slince\OAuth;

abstract class AbstractService implements ServiceInterface
{

    static $signal;
    
    protected $_clientId;

    protected $_clientSecret;
    
    protected $_links = [];
    
    protected $_api = [];

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

    function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
    }
}