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

    public static function getVersion() : string {
        $version = $_SERVER['HTTP_VERSION'] ?? "V1";
        return $version;
    }

    public static function getRequest() {
        return $_REQUEST;
    }

    /**
     * 获取HTTP Method，考虑了业界约定俗成的两种覆写方式
     * @return string HTTP Method: GET, POST, PUT, DELETE
     */
    public static function getMethod() : string {
        $method = isset($_SERVER['REQUEST_METHOD'])
            ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';

        $method_override = '';
        if (isset($_REQUEST['http_method_override'])) {
            $method_override = strtoupper($_REQUEST['http_method_override']);
        } elseif (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            $method_override = strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        switch ($method_override) {
            case 'PUT':
            case 'DELETE':
                $method = $method_override;
                break;
            default:
                break;
        }

        return $method;
    }

    /**
     * 获取HTTP raw body
     * @return string HTTP POST/PUT body
     * 注意：php://input is not available with enctype="multipart/form-data".
     */
    public static function getBody() : string {
        if (!isset($_SERVER['HTTP_RAW_POST_BODY'])) {
            $_SERVER['HTTP_RAW_POST_BODY'] = @file_get_contents('php://input');
        }
        return $_SERVER['HTTP_RAW_POST_BODY'];
    }

    /**
     * 这货就是用于判断请求的Content-Type是不是JSON类型
     * @return bool
     */
    public static function contentTypeIsJson() : bool {
        $content_type = isset($_SERVER['HTTP_CONTENT_TYPE'])
            ? $_SERVER['HTTP_CONTENT_TYPE'] : '';
        if (!preg_match('#^application/json#', $content_type)) {
            return false;
        }
        return true;
    }

    /**
     * 获取用户的语言类型
     * @return string
     */
    public static function getAcceptLanguage() : string {
        return isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
            ? trim($_SERVER['HTTP_ACCEPT_LANGUAGE'])
            : 'en-us';
    }

    /**
     * 获取用户的语言类型
     * @return string
     */
    public static function getLanguage() : string {
        $lang = self::getAcceptLanguage();
        $lang = strtolower($lang);
        if (preg_match('/^zh\-(cn|sg)/i', $lang)) {
            return 'zh-cn';
        } elseif (preg_match('/^zh\-(tw|hk)/i', $lang)) {
            return 'zh-tw';
        } elseif (preg_match('/^zh/i', $lang)) {
            return 'zh-cn';
        } elseif (preg_match('/^en/i', $lang)) {
            return 'en-us';
        }elseif(preg_match('/^([a-z]{1,})-([a-z]{1,})/i', $lang, $match)){
            return strval($match[1]);
        }elseif(preg_match('/^([a-z]{1,})-/i', $lang, $match)){
            return strval($match[1]);
        }elseif(preg_match('/^-([a-z]{1,})/i', $lang, $match)){
            return strval($match[1]);
        }else{
            return "";
        }
    }

    /**
     * 获取用户真实IP地址
     * @return string|int IP地址
     */
    public static function getRealIp($return_long = false) {
        $ip = isset($_SERVER['HTTP_X_REAL_IP'])
            ? trim($_SERVER['HTTP_X_REAL_IP']) : '';
        $ip = empty($ip) ? trim($_SERVER['REMOTE_ADDR']) : $ip;

        $return_long = !!$return_long;
        if ($return_long) {
            $ip = ip2long($ip);
        }

        return $ip;
    }
}