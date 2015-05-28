<?php
namespace Slince\OAuth;

class Baidu extends AbstractSite
{

    static $signal = 'baidu';
    
    protected $_urls = [
        'authorizeUrl' => 'http://openapi.baidu.com/oauth/2.0/authorize',
        'tokenUrl' => 'https://openapi.baidu.com/oauth/2.0/token',
        'refreshTokenUrl' => 'https://openapi.baidu.com/rest/2.0/passport/users/getInfo'
    ];
    
    protected $_requestHttpMethod = 'GET';
    
    function getCurrentUser()
    {
        
    }
}