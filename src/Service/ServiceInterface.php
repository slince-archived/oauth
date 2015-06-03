<?php
namespace Slince\OAuth\Service;

interface ServiceInterface
{
    function setCertificate();
    
    function getCertificate();
    
    function getAuthorizeUrl();
    
    function getCurrentUser();
}