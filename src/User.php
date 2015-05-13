<?php
namespace Slince\OAuth;

class User extends AbstractUser
{
    function share($messages) {
        $this->getFromSite()->share($messages);
    }
}