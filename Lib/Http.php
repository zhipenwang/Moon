<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-24
 * Time: 10:43
 */

namespace Lib;

use Config\HttpCode;

class Http {

    public static function httpRpcResponse(int $code, array $msg) {
        if (array_key_exists($code, HttpCode::$ErrorCode) === false) {
            $code = HttpCode::API_CODE_OK;
        }
        $message = HttpCode::$ErrorCode[$code];
        $return_data = $msg["data"] ?? [];
        $data = [
            "code"      => $code,
            "message"   => $message,
            "data"      => $return_data,
        ];
        return json_encode($data);
    }

    public static function httpResponse(int $code, array $msg) {
        if (array_key_exists($code, HttpCode::$ErrorCode) === false) {
            $code = HttpCode::API_CODE_OK;
        }
        $message = HttpCode::$ErrorCode[$code];
        $return_data = $msg["data"] ?? [];
        $data = [
            "code"      => $code,
            "message"   => $message,
            "data"      => $return_data,
        ];
        echo json_encode($data);
        exit();
    }
}