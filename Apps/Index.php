<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-24
 * Time: 11:25
 */

namespace Apps;

use Config\HttpCode;
use Lib\Http;

class Index {

    public function index() {
        Http::httpResponse(HttpCode::API_CODE_OK, [
            "code"  => HttpCode::API_CODE_OK,
            "data"  => [1,2,3],
        ]);
    }
}