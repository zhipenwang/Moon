<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 11:30
 * Description: example for Yar server
 */

class Test {

    /**
     * Simple addition calculation
     * @param int $a
     * @param int $b
     * @return int
     */
    public function fun_add(int $a, int $b) :int {
        return $a+$b;
    }
}

try {
    $server = new Yar_Server(new Test());
    $server->handle();
} catch (Exception $exception) {
    echo $exception->getMessage();
}