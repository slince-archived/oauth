<?php
/**
 * slince oauth2.0 library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\OAuth\Certificate;

class Certificate implements CertificateInterface
{

    /**
     * client id
     *
     * @var string
     */
    protected $_clientId;

    /**
     * client secret
     *
     * @var string
     */
    protected $_clientSecret;

    /**
     * 授权回调页地址
     *
     * @var string
     */
    protected $_callbackUrl;

    function __construct($clientId, $clientSecret, $callbackUrl)
    {
        $this->_clientId = $clientId;
        $this->_clientSecret = $clientSecret;
        $this->_callbackUrl = $callbackUrl;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::getClientId()
     */
    function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::setClientId()
     */
    function setClientId($clientId)
    {
        $this->_clientId = $clientId;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::setClientSecret()
     */
    function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::getClientSecret()
     */
    function getClientSecret()
    {
        return $this->_clientSecret;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::setCallbackUrl()
     */
    function setCallbackUrl($callbackUrl)
    {
        $this->_callbackUrl = $callbackUrl;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\OAuth\Certificate\CertificateInterface::getCallbackUrl()
     */
    function getCallbackUrl()
    {
        return $this->_callbackUrl;
    }
}