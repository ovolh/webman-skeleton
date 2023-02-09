<?php

namespace support\exception;

use App\Util\ReturnCode;
use Tinywan\ExceptionHandler\Handler as baseHandler;
use Webman\Http\Response;

class ApiHandler extends baseHandler
{
    public $errorCode = ReturnCode::INVALID;

    /**
     * 构造 Response.
     *
     * @return Response
     */
    protected function buildResponse(): Response
    {
        $bodyKey = array_keys($this->config['body']);
        $responseBody = [
                $bodyKey[0] ?? 'code' => $this->errorCode,
                $bodyKey[1] ?? 'message' => $this->errorMessage,

        ];
        if (config('app.debug')) {
            $responseBody[$bodyKey[2] ?? 'data'] = $this->responseData;
        } else {
            $responseBody[$bodyKey[2] ?? 'data'] = [];
        }

        $header = array_merge(['Content-Type' => 'application/json;charset=utf-8'], $this->header);
        return new Response($this->statusCode, $header, json_encode($responseBody));
    }
}