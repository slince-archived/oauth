<?php
namespace Slince\OAuth\Certificate;

interface CertificateInterface
{

    function setClientId();

    function setClientSecret();

    function getClientId();

    function getClientSecret();
}