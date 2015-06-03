<?php
namespace Slince\OAuth\Token;

class Token implements TokenInterface
{

    private $_accessToken;

    private $_refreshToken;

    private $_expireTime;

    function setAccessToken($token)
    {
        $this->_accessToken = $token;
    }

    function getAccessToken()
    {
        return $this->_accessToken;
    }

    function setRefreshToken($token)
    {
        $this->_refreshToken = $token;
    }

    function getRefreshToken()
    {
        return $this->_refreshToken;
    }

    function setExpireTime($time)
    {
        $this->_expireTime = $time;
    }

    function getExpireTime()
    {
        return $this->_expireTime;
    }

    function isExpired()
    {
        return time() > $this->_expireTime;
    }
}