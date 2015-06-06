<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Service;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Token\TokenInterface;

interface ServiceInterface
{

    /**
     * 设置证书
     *
     * @param CertificateInterface $certificate            
     */
    function setCertificate(CertificateInterface $certificate);

    /**
     * 获取证书
     */
    function getCertificate();

    /**
     * 设置token
     *
     * @param TokenInterface $token            
     */
    function setToken(TokenInterface $token);

    /**
     * 获取token
     */
    function getToken();

    /**
     * 获取授权页地址
     *
     * @param array $extraParams            
     */
    function getAuthorizeUrl($extraParams = []);

    /**
     * 授权页基本地址
     */
    function getBaseAuthorizeUri();

    /**
     * token页基本地址
     */
    function getBaseTokenUri();

    /**
     * 获取api请求方式
     */
    function getRequestMethod();

    /**
     * 授权方式
     */
    function getAuthorizeMethod();

    /**
     * api页基本地址
     */
    function getBaseUri();

    /**
     * 获取完整的api地址
     *
     * @param unknown $path            
     */
    function getFullUrl($path);

    /**
     * 请求api
     *
     * @param string $path            
     * @param array $params            
     */
    function request($path, $params = []);

    /**
     * 根据授权码获取token
     *
     * @param string $code            
     * @return TokenInterface
     */
    function requestToken($code);

    /**
     * 刷新当前token
     *
     * @param TokenInterface $token            
     * @return TokenInterface
     */
    function refreshToken(TokenInterface $token = null);

    /**
     * 从响应获取token参数
     *
     * @param string $body            
     * @param TokenInterface $token            
     */
    function retrieveTokenFromResponse($body, TokenInterface $token);
}