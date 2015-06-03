<?php
namespace Slince\OAuth\Service;

use Slince\OAuth\Certificate\CertificateInterface;
use Slince\OAuth\Token\TokenInterface;

abstract class AbstractService implements ServiceInterface
{

    static $signal;

    /**
     * 身份证书
     * 
     * @var CertificateInterface
     */
    protected $_certificate;

    /**
     * token
     * 
     * @var TokenInterface
     */
    protected $_token;

    protected $_links = [];

    protected $_api = [];

    function __construct(CertificateInterface $certificate, TokenInterface $token = null)
    {
        $this->_certificate = $certificate;
        $this->_token = $token;
    }
    
    function request()
    {
        
    }
    function requestToken($code)
    {
        
    }
    function refreshToken(TokenInterface $token)
    {
        
    }
    
}