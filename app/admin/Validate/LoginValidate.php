<?php

namespace app\admin\validate;


use app\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'password' => 'require|min:3',
        'email' => 'require|email',
    ];

    protected $message = [
        'password.require' => '密码必须',
        'password.max' => '密码最少3个字符',
        'email.require' => '邮箱必须',
        'email' => '邮箱格式错误',
    ];
}