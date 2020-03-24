<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-24
 * Time: 11:16
 */

namespace Services;

class Request {

    public static function getServer() {
        return $_SERVER;
    }

    public static function getRpcHeader() {
        $rpc_header = $_SERVER['HTTP_RPC'] ?? false;
        $rpc_header = boolval($rpc_header);
        return $rpc_header;
    }
}