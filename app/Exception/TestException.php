<?php

namespace App\Exception;

use Tinywan\ExceptionHandler\Exception\BaseException;

class TestException extends BaseException
{
    /**
     * @var int
     */
    public $statusCode = 405;

    /**
     * @var int
     */
    public $errorCode = -111;

    /**
     * @var string
     */
    public $errorMessage = 'test';
}