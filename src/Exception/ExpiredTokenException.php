<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Exception;

class ExpiredTokenException extends OAuthException
{

    function __construct()
    {
        $message = "Token failure";
        parent::__construct($message);
    }
}