<?php
namespace Slince\OAuth\Exception;

class ExpiredTokenException extends OAuthException
{
    function __construct()
    {
        $message = "Token failure";
        parent::__construct($message);
    }
}