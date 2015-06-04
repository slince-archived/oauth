<?php
namespace Slince\OAuth;

use GuzzleHttp\Client;
use Slince\OAuth\Exception\BadRequestException;

class RequestFactory
{

    static $_httpclient;

    static function create($url, $options = [], $httpMethod = 'get')
    {
        try {
            $response = self::getClient()->$httpMethod($url, $options);
            if ($response->getStatusCode() == 200) {
                return $response->getBody();
            }
        } catch (\Exception $e) {
            throw $e;
            //throw new BadRequestException($url);
        }
        throw new BadRequestException($url);
    }

    static function getClient()
    {
        if (is_null(self::$_httpclient)) {
            self::$_httpclient = new Client();
        }
        return self::$_httpclient;
    }
}