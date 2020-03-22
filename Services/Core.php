<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 13:06
 */

namespace Services;

class Core {

    public function run() {
        $script_url = $_SERVER['REQUEST_URI'];
        $handle = \Config\Router::$router[$script_url];
        new $handle['class'];
    }
}