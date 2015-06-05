<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Certificate;

interface CertificateInterface
{

    /**
     * 设置client id
     *
     * @param string $clientId            
     */
    function setClientId($clientId);

    /**
     * 获取client id
     */
    function getClientId();

    /**
     * 设置client secret
     *
     * @param string $clientSecret            
     */
    function setClientSecret($clientSecret);

    /**
     * 获取client secret
     */
    function getClientSecret();

    /**
     * 设置授权回调页地址
     *
     * @param string $callbackUrl            
     */
    function setCallbackUrl($callbackUrl);

    /**
     * 获取授权回调页地址
     */
    function getCallbackUrl();
}