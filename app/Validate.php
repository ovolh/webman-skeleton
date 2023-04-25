<?php

namespace App;

use support\Container;
use Tinywan\Validate\Validate as Base;

/**
 * 验证基础类
 */
class Validate extends Base
{
    /**
     * 验证
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate();
    }

    /**
     * 初始化验证
     * @return bool
     */
    protected function validate()
    {
        if (method_exists($this, 'rules') || $this->rule) {
            $validate = Container::get(Validate::class);

            // 验证
            $message = [];
            if (method_exists($this, 'messages')) {
                $message = $this->messages();
            }
            if ($this->message) {
                $message = array_merge($message, $this->message);
            }
            $rule = [];
            if (method_exists($this, 'rules')) {
                $rule = $this->rules();
            }
            if ($this->rule) {
                $rule = array_merge($rule, $this->rule);
            }

            return $validate->rule($rule)->message($message)->batch($this->batch)->failException(true)->check(request()->all());
        }

        return true;
    }
}