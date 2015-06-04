<?php
namespace Slince\OAuth;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Service\ServiceInterface;
use Slince\OAuth\Token\TokenInterface;

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

    /**
     * 创建服务
     * @param string $serviceName
     * @param CertificateInterface $certificate
     * @throws OAuthException
     * @return ServiceInterface
     */
    static function get($serviceName, CertificateInterface $certificate, TokenInterface $token, $scopes = [])
    {
        if (isset(self::$serviceMap[$serviceName])) {
            $serviceClassName = 'Slince\\OAuth\\Service\\' . self::$serviceMap[$serviceName];
        } else {
            throw new OAuthException(sprintf("Service %s does not support", $serviceName));
        }
        return new $serviceClassName($certificate, $token, $scopes);
    }
}