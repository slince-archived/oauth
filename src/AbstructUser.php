<?php
namespace Slince\OAuth;

abstract class AbstructUser implements UserInterface
{
    private $_id;
    private $_userInfo = [];
    
    function __construct($id, $userInfo)
    {
        $this->_id = $id;
        $this->_userInfo = $userInfo;
    }
    
    function getId()
    {
        return $this->_id;
    }
    
}