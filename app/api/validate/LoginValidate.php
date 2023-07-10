<?php

namespace app\api\validate;


use app\validate;

class LoginValidate extends Validate
{
    protected $rules = [
        'password' => 'require|min:3',
        'email' => 'require|email',
    ];

    protected $messages = [
        'password.require' => '密码必须',
        'password.max' => '密码最少3个字符',
        'email.require' => '邮箱必须',
        'email' => '邮箱格式错误',
    ];
}