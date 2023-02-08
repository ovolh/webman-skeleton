<?php
namespace App\Event;

class User
{
    function register($user)
    {
        var_export($user);
    }

    function logout($user)
    {
        var_export($user);
    }
}