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
            "V1"    => [
                "class" => \AppsRpc\V1\Index::class,
                "rpc"   => true,
            ],
            "V2"    => [
                "class" => \AppsRpc\V2\Index::class,
                "rpc"   => true,
            ],
        ],
    ];

    public static $router = [
        "/index"    => [
            "V1"    => [
                "class"     => \Apps\V1\Index::class,
                "access"    => ["GET"],
                "auth"      => ["GET"],
                "action"    => "index",
                "rpc"       => false,
            ],
            "V2"    => [
                "class"     => \Apps\V2\Index::class,
                "access"    => ["GET"],
                "auth"      => ["GET"],
                "action"    => "index",
                "rpc"       => false,
            ],
        ],
    ];
}