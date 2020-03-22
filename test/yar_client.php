<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 11:30
 * Description: example for Yar client
 */

try {
    $host = "moon.com";
    $client = new Yar_Client("http://{$host}/test/yar_server.php");
    echo $client->fun_add(1, 2);
} catch (Exception $exception) {
    echo $exception->getMessage();
}