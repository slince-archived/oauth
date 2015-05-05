<?php
namespace Slince\OAuth;

interface UserInterface
{
    function getId();
    
    function getAttribute($attribute);
}