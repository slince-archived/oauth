<?php
namespace Slince\OAuth\Token;

interface TokenInterface
{

    function setAccessToken();

    function getAccessToken();

    function setRefreshToken();

    function getRefreshToken();

    function setExpireTime();

    function getExpireTime();

    function isExpired();
    
}