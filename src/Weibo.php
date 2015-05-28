<?php
namespace Slince\OAuth;

class Weibo extends AbstractSite
{

    static $signal = 'weibo';
    
    protected $_urls = [
        'authorizeUrl' => 'https://api.weibo.com/oauth2/authorize',
        'tokenUrl' => 'https://api.weibo.com/oauth2/access_token',
        'refreshTokenUrl' => 'https://api.weibo.com/2/users/show.json'
    ];
    
     protected $_requestHttpMethod = 'POST';
    
    function getCurrentUser()
    {
        
    }
}