<?php
namespace Slince\OAuth;

interface ThirdPartySiteInterface
{
    function getAuthorizeUrl();
    
    function getCurrentUser();
}