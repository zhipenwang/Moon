<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 12:18
 */

namespace Apps;

class Index {

    public function __construct() {
        $yar_server = new \Yar_Server($this);
        $yar_server->handle();
    }

    /**
     * @return string
     */
    public function index() :string {
        return "hello world";
    }

    /**
     * @return string
     */
    public function execute() :string {
        return "hello execute";
    }
}