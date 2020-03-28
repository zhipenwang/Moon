<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-23
 * Time: 10:21
 */

namespace Services;

use Config\HttpCode;
use Config\Router;
use Lib\Http;

class Moon extends Core {

    public function requestRpcDo(string $script_url) {
        // TODO: Implement requestRpcDo() method.

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
    }

    public function requestDo(string $script_url) {
        // TODO: Implement requestDo() method.
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
        if (!isset($handle['class']) || class_exists($handle['class']) === false) {
            Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                "code"  => HttpCode::API_CODE_NOT_FOUND,
                "data"  => [],
            ]);
        }

        // 校验http method
        $http_method = Request::getMethod();
        if (!in_array($http_method, $handle['access'])) {
            Http::httpResponse(HttpCode::API_CODE_METHOD_NOT_ALLOWED, [
                "code"  => HttpCode::API_CODE_METHOD_NOT_ALLOWED,
                "data"  => [],
            ]);
        }

        // 鉴权
        if (in_array($http_method, $handle['auth'])) {
            // TODO: 鉴权处理方法
            $this->authentication();
        }
        $class = new $handle['class'];

        // 前置方法
        if (method_exists($class, 'init')) {
            call_user_func_array([$class, 'init'], []);
        }

        // 执行业务方法
        $action = $handle['action'] ?? "execute";
        if (method_exists($class, $action) === false) {
            Http::httpResponse(HttpCode::API_CODE_NOT_FOUND, [
                "code"  => HttpCode::API_CODE_NOT_FOUND,
                "data"  => [],
            ]);
        }
        call_user_func_array([$class, $action], []);

        // 后置方法
        if (method_exists($class, 'done')) {
            call_user_func_array([$class, 'done'], []);
        }
    }

    public function authentication() {
        // TODO: Implement authentication() method.
    }
}