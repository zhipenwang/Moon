<?php
/**
 * Created by PhpStorm.
 * User: wangzhipeng
 * Date: 2020-03-22
 * Time: 12:18
 */

namespace Apps;

use Services\Apps;

class Index extends Apps {

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