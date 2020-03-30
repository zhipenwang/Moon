<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 13:04
 */

namespace Services;

class AppsRpc implements AppsInterface {

    public function __construct() {

        // 前置方法
        if (method_exists($this, 'init')) {
            call_user_func_array([$this, 'init'], []);
        }

        $yar_server = new \Yar_Server($this);
        $yar_server->handle();

        // 后置方法
        if (method_exists($this, 'done')) {
            call_user_func_array([$this, 'done'], []);
        }
    }

    public function init() {
        // TODO: Implement init() method.
    }

    public function done() {
        // TODO: Implement done() method.
    }
}