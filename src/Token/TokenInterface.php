<?php
namespace Slince\OAuth\Token;

interface TokenInterface
{

    function setAccessToken($token);

    function getAccessToken();

    function setRefreshToken($token);

    function setExpireTime($time);

    function getExpireTime();

    function isExpired();
    
    function setExtraParams(array $params);
    
    function getExtraParams();
    
    function setExtraParam($name, $value);
    
    function getExtraParam($name);
    
}