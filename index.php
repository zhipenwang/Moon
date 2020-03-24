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


$app = new \Services\Moon();
$app->run();