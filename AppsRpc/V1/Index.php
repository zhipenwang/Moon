<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-25
 * Time: 10:15
 */

namespace AppsRpc\V1;

use Config\HttpCode;
use Lib\Http;
use Services\AppsRpc;

class Index extends AppsRpc {

    /**
     * @return string
     */
    public function index() :string {
        return Http::httpRpcResponse(HttpCode::API_CODE_OK, [
            "code"  => HttpCode::API_CODE_OK,
            "data"  => "hello world V1",
        ]);
    }

    /**
     * @return string
     */
    public function execute() :string {
        return Http::httpRpcResponse(HttpCode::API_CODE_OK, [
            "code"  => HttpCode::API_CODE_OK,
            "data"  => "hello execute V1",
        ]);
    }
}