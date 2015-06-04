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
}