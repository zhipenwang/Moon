<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 13:04
 */

namespace Services;

class AppsRpc {

    public function __construct() {
        $yar_server = new \Yar_Server($this);
        $yar_server->handle();
    }
}