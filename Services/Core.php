<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 13:06
 */

namespace Services;

use Config\HttpCode;
use Lib\Http;

class Core {

    public function run() {
        $script_url = preg_replace("/\?.*$/", "", $_SERVER['REQUEST_URI']);
        if (empty($script_url) || $script_url === '/' || !isset(\Config\Router::$router[$script_url])) {
            Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                "code"  => HttpCode::API_CODE_NOT_FOUND,
                "data"  => [],
            ]);
        }

        $handle = \Config\Router::$router[$script_url];
        new $handle['class'];
    }
}