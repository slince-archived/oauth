<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Token;

class Token implements TokenInterface
{

    /**
     * access token
     * 
     * @var string
     */
    protected $_accessToken;

    /**
     * refresh token
     * 
     * @var string
     */
    protected $_refreshToken;

    /**
     * 过期时间
     * 
     * @var int
     */
    protected $_expireTime;

    /**
     * 附加参数
     * 
     * @var array
     */
    protected $_extraParams = [];

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::setAccessToken()
     */
    function setAccessToken($token)
    {
        $this->_accessToken = $token;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::getAccessToken()
     */
    function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::setRefreshToken()
     */
    function setRefreshToken($token)
    {
        $this->_refreshToken = $token;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::getRefreshToken()
     */
    function getRefreshToken()
    {
        return $this->_refreshToken;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::setExpireTime()
     */
    function setExpireTime($time)
    {
        $this->_expireTime = $time;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::getExpireTime()
     */
    function getExpireTime()
    {
        return $this->_expireTime;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::isExpired()
     */
    function isExpired()
    {
        return time() > $this->_expireTime;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::setExtraParams()
     */
    function setExtraParams(array $param)
    {
        $this->_extraParams = $param;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::getExtraParams()
     */
    function getExtraParams()
    {
        return $this->_extraParams;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::setExtraParam()
     */
    function setExtraParam($name, $value)
    {
        $this->_extraParams[$name] = $value;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\OAuth\Token\TokenInterface::getExtraParam()
     */
    function getExtraParam($name, $default = null)
    {
        return isset($this->_extraParams[$name]) ? $this->_extraParams[$name] : $default;
    }
}