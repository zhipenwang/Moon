<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 12:36
 */

namespace Config;

class Router {

    public static $rpc_router = [
        "/index"    => [
            "class" => \AppsRpc\Index::class,
            "rpc"   => true,
        ],
    ];

    public static $router = [
        "/index"    => [
            "class" => \Apps\Index::class,
            "method"=> "index",
            "rpc"   => false,
        ],
    ];
}