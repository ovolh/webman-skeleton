<?php

namespace app;

use support\Container;
use Tinywan\Validate\Validate as Base;

/**
 * 验证基础类
 */
class Validate
{
    protected $rules = [];
    protected $messages = [];
    protected $batch = false;
    protected $failException = true;


    public function __construct()
    {
        $this->validate();
    }

    /**
     * 验证
     *
     * @return bool
     */
    protected function validate()
    {
        if (method_exists($this, 'rules') || $this->rules) {
            $validate = Container::get(Base::class);

            // 验证
            $messages = $this->messages;
            if (method_exists($this, 'messages')) {
                $messages = array_merge($messages, $this->messages());
            }
            $rules = $this->rules;
            if (method_exists($this, 'rules')) {
                $rules = array_merge($rules, $this->rules());
            }

            return $validate->rule($rules)->message($messages)->batch($this->batch)->failException($this->failException)->check(request()->all());
        }

        return true;
    }
}