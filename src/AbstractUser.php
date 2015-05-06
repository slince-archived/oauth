<?php
namespace Slince\OAuth;

abstract class AbstractUser implements UserInterface
{

    protected $_id;

    protected $_userInfo = [];
    
    protected $_fromSite;
    
    protected $_accessToken;
    
    protected $_refreshToken;

    function __construct($id, $fromSite)
    {
        $this->_id = $id;
        $this->_fromSite = $fromSite;
    }

    function getId()
    {
        return $this->_id;
    }

    function getAttribute($attribute)
    {
        return isset($this->_userInfo[$attribute]) ? $this->_userInfo[$attribute] : null;
    }
    
    function getFromSite()
    {
        return $this->_fromSite;
    }
}