<?php
namespace Slince\OAuth;

use Slince\OAuth\Certificate\CertificateInterface;

class ServiceFactory
{

    const SERVICE_WEIBO = 'weibo';

    const SERVICE_BAIDU = 'baidu';

    const SERVICE_QQ = 'qq';

    static $serviceMap = [
        self::SERVICE_WEIBO => 'Weibo',
        self::SERVICE_BAIDU => 'Baidu',
        self::SERVICE_QQ => 'QQ'
    ];

    static function create($serviceName, CertificateInterface $certificate)
    {
        if (isset(self::$serviceMap[$serviceName])) {
            $serviceClassName = 'Service\\' . self::$serviceMap[$serviceName];
        } else {
            throw new OAuthException(sprintf("Service %s does not support", $serviceName));
        }
        return new $serviceClassName($certificate);
    }
}