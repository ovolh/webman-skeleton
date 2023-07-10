<?php
/**
 * Here is your custom functions.
 */

use app\util\ReturnCode;
use support\Response;

/**
 * @param $data
 * @param int $httpCode
 * @param array $headers
 * @param int $options
 * @return Response
 */
function api_json($data, int $httpCode = 200, array $headers = [], int $options = JSON_UNESCAPED_UNICODE): Response
{
    $response = response(json_encode($data, $options), $httpCode);

    $response->header('Content-Type', 'application/json');
    if ($headers) {
        $response->withHeaders($headers);
    }
    return $response;
}

/**
 * 成功返回json
 *
 * @param $data
 * @param string $message
 * @param integer $code
 * @param array $headers
 * @return Response
 */
function success($data = [], string $message = 'success', int $code = ReturnCode::SUCCESS, array $headers = []): Response
{
    if ($data) {
        if (is_string($data)) {
            $data = [$data];
        }
    }
    return api_json(['code' => $code, 'message' => $message, 'data' => $data], 200, $headers);
}

/**
 * 失败返回json
 *
 * @param string $message
 * @param $data
 * @param integer $code
 * @param array $headers
 * @return Response
 */
function fail(string $message = 'fail', $data = [], int $code = ReturnCode::INVALID, array $headers = []): Response
{
    if ($data) {
        if (is_string($data)) {
            $data = [$data];
        }
    }
    return api_json(['code' => $code, 'message' => $message, 'data' => $data], 200, $headers);
}

/**
 *
 * @param int|string $status
 * @param string $message
 * @param array $data
 * @return array
 */
function call_back(int|string $status, string $message = '', array $data = []): array
{
    return [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
}