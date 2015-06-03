<?php
namespace Slince\OAuth;

use GuzzleHttp\Client;
use Slince\OAuth\Exception\BadRequestException;

class RequestFactory
{

    static $_httpclient;

    static function create($url, $params = [], $httpMethod = 'get')
    {
        $response = self::getClient()->$httpMethod($url, $params);
        if ($response->getStatusCode == 200) {
            return $response->getBody();
        }
        throw new BadRequestException($url);
    }

    static function getClient()
    {
        if (is_null(self::$_httpclient)) {
            self::$_httpclient = new GuzzleHttp\Client();
        }
        return self::$_httpclient;
    }
}