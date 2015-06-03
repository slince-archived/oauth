<?php
namespace Slince\OAuth\Exception;

class BadRequestException extends OAuthException
{
    function __construct($requestUrl)
    {
        $message = sprintf("url %s request error", $requestUrl);
        parent::__construct($message);
    }
}