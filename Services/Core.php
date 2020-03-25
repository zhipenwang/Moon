<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 13:06
 */

namespace Services;

use Config\HttpCode;
use Config\Router;
use Lib\Http;

class Core {

    public function run() {
        $script_url = preg_replace("/\?.*$/", "", $_SERVER['REQUEST_URI']);
        if (empty($script_url) || $script_url === '/') {
            Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                "code"  => HttpCode::API_CODE_NOT_FOUND,
                "data"  => [],
            ]);
        }

        if (Request::getRpcHeader() === true) {
            if (!isset(Router::$rpc_router[$script_url])) {
                Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                    "code"  => HttpCode::API_CODE_NOT_FOUND,
                    "data"  => [],
                ]);
            }
            $version = Request::getVersion();
            if (!isset(Router::$rpc_router[$script_url][$version])) {
                Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                    "code"  => HttpCode::API_CODE_NOT_FOUND,
                    "data"  => [],
                ]);
            }
            $handle = Router::$rpc_router[$script_url][$version];
            new $handle['class'];
        } else {
            if (!isset(Router::$router[$script_url])) {
                Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                    "code"  => HttpCode::API_CODE_NOT_FOUND,
                    "data"  => [],
                ]);
            }
            $version = Request::getVersion();
            if (!isset(Router::$router[$script_url][$version])) {
                Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                    "code"  => HttpCode::API_CODE_NOT_FOUND,
                    "data"  => [],
                ]);
            }
            $handle = Router::$router[$script_url][$version];
            $class = new $handle['class'];
            call_user_func_array([$class, $handle['method']], []);
        }
    }
}