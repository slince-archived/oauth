<?php
namespace Slince\OAuth\Certificate;

class CertificateInterface
{

    function setClientId();

    function setClientSecret();

    function getClientId();

    function getClientSecret();
}