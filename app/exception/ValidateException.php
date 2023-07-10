<?php

namespace app\exception;

use app\util\ReturnCode;
use Tinywan\ExceptionHandler\Exception\BaseException;

class ValidateException extends BaseException
{
    /**
     * @var int
     */
    public $statusCode = 200;

    /**
     * @var int
     */
    public $errorCode = ReturnCode::INVALID;

    /**
     * @var string
     */
    public $errorMessage = '参数错误';
}