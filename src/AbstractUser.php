<?php
namespace Slince\OAuth;

abstract class AbstractUser implements UserInterface
{

    protected $_id;

    protected $_userInfo = [];
    
    
    protected $_fromSite;

    function __construct($id, $userInfo, $fromSite)
    {
        $this->_id = $id;
        $this->_userInfo = $userInfo;
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