<?php

namespace app\event;

class User
{
    function register($user, $event_name)
    {
        var_export($user);
    }

    function logout($user)
    {
        var_export($user);
    }
}