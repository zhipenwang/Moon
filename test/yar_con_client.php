<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 11:59
 */

function callback($result, $callinfo) {
    if ($callinfo == null) {
        echo sprintf("Now, all requests are sent, and no any response available\n");
    } else {
        echo sprintf("This is a remote call response\n");
        echo sprintf("The method name is %s\n", $callinfo["method"]);
        echo sprintf("The sequence is %s\n", $callinfo['sequence']);
        echo sprintf("The result is %d\n", $result);
    }
    echo "\n";
}

function error_callback($type, $error, $callinfo) {
    error_log($error);
}

try {
    $host = "moon.com";

    // 注册并行的服务调用
    Yar_Concurrent_Client::call("http://{$host}/test/yar_server.php", "fun_add", [1, 2], "callback");
    Yar_Concurrent_Client::call("http://{$host}/test/yar_server.php", "fun_add", [2, 2], "callback");
    Yar_Concurrent_Client::call("http://{$host}/test/yar_server.php", "fun_add", [3, 2], "callback");

    // 发送所有注册的并行调用给服务
    Yar_Concurrent_Client::loop("callback", "error_callback");

    // 注销所有的注册的并行调用
    Yar_Concurrent_Client::reset();

} catch (Exception $exception) {
    echo $exception->getMessage();
}