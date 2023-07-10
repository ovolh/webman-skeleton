<?php

namespace app\exception;

use app\util\ReturnCode;
use Tinywan\ExceptionHandler\Exception\BaseException;

class BadRequestException extends BaseException
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
    public $errorMessage = '请求出错';
}