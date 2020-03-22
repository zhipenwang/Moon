<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 12:14
 */


spl_autoload_register(function (string $name) {
    $name = str_replace("\\", DIRECTORY_SEPARATOR, $name);
    $file_name = __DIR__ . "/{$name}.php";
    if (file_exists($file_name)) {
        include_once($file_name);
    }
});

$script_url = $_SERVER['REQUEST_URI'];
$handle = \Config\Router::$router[$script_url];
new $handle['class'];