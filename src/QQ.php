<?php
namespace Slince\OAuth;

class QQ extends AbstractSite
{

    static $signal = 'qq';
    
    protected $_urls = [
        'authorizeUrl' => 'https://graph.qq.com/oauth2.0/authorize',
        'tokenUrl' => 'https://graph.qq.com/oauth2.0/token',
        'refreshTokenUrl' => 'https://graph.qq.com/oauth2.0/token'
    ];
    protected $_requestHttpMethod = 'GET';
    function setUrl($name, $url)
    {
        $this->_urls[$name] = $url;
    }
    function setUrls($urls)
    {
        $this->_urls = $urls;
    }
    /**
     * 当前用户
     */
    function me()
    {
        
    }
}