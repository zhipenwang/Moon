<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-25
 * Time: 10:23
 */

namespace Apps\V2;

use Config\HttpCode;
use Lib\Http;

class Index {

    public function index() {
        Http::httpResponse(HttpCode::API_CODE_OK, [
            "code"  => HttpCode::API_CODE_OK,
            "data"  => ["V2"],
        ]);
    }
}