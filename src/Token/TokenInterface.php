<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Token;

interface TokenInterface
{

    /**
     * 设置accesz token
     *
     * @param string $token            
     */
    function setAccessToken($token);

    /**
     * 获取access token
     */
    function getAccessToken();

    /**
     * 设置refresh token
     *
     * @param string $token            
     */
    function setRefreshToken($token);

    /**
     * 获取refresh token
     *
     * @param string $token            
     */
    function getRefreshToken();

    /**
     * 设置过期时间
     *
     * @param string $time            
     */
    function setExpireTime($time);

    /**
     * 获取过期时间
     */
    function getExpireTime();

    /**
     * 判断是否过期
     */
    function isExpired();

    /**
     * 设置额外参数
     *
     * @param array $params            
     */
    function setExtraParams(array $params);

    /**
     * 获取额外参数
     */
    function getExtraParams();

    /**
     * 单个设置额外参数
     *
     * @param string $name            
     * @param mixed $value            
     */
    function setExtraParam($name, $value);

    /**
     * 获取额外参数
     *
     * @param string $name            
     */
    function getExtraParam($name);
}