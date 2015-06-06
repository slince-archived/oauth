<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth;

use GuzzleHttp\Client;
use Slince\OAuth\Exception\BadRequestException;

class RequestFactory
{

    static $_httpclient;

    /**
     * 创建一个请求
     * @param string $url
     * @param array $options
     * @param string $httpMethod
     * @throws BadRequestException
     */
    static function create($url, $options = [], $httpMethod = 'get')
    {
        $options['verify'] = false;
        try {
            $response = self::getClient()->$httpMethod($url, $options);
            if ($response->getStatusCode() == 200) {
                return $response->getBody();
            }
        } catch (\Exception $e) {
            throw new BadRequestException($url);
        }
    }

    /**
     * 获取请求client
     * @return \GuzzleHttp\Client
     */
    static function getClient()
    {
        if (is_null(self::$_httpclient)) {
            self::$_httpclient = new Client([
                'verify' => false
            ]);
        }
        return self::$_httpclient;
    }
}