<?php
namespace Slince\OAuth;

abstract class AbstructUser implements UserInterface
{

    private $_id;

    protected $_userInfo = [];
    
    protected $_signal;

    function __construct($id, $userInfo, $signal)
    {
        $this->_id = $id;
        $this->_userInfo = $userInfo;
        $this->_signal = $signal;
    }

    function getId()
    {
        return $this->_id;
    }

    function getAttribute($attribute)
    {
        return isset($this->_userInfo[$attribute]) ? $this->_userInfo[$attribute] : null;
    }
    
    function getSignal()
    {
        return $this->_signal;
    }
}