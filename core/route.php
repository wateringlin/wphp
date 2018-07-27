<?php
/**
 * 路由控制
 */

namespace core;

use core\config;

class route {

    public $ctrl; // 控制器名
    public $action; // 方法名
    public $params = array(); // 参数

    public function __construct() {
        // echo 'route is ready';
        /**
         * 1、隐藏index.php
         * 2、获取URL中的控制器和方法
         * 3、获取URL中的参数
         * 4、支持localhost
         */
        $this->ctrl = config::get('CTRL', 'route_config');
        $this->action = config::get('ACTION', 'route_config');
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI']; // localhost/index.php/user/login => /user/login
            $patharr = explode('/', trim($path, '/'));
        } else {
            $patharr = array();
        }
        if (isset($_SERVERE['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')) {
            // 去掉项目名称
            $patharr = array_slice($patharr, 1, count($patharr) - 1); // array_slice(array, start, length)
        }
        if (isset($patharr[0])) {
            if ($patharr[0] != 'index.php') {
                // 省略了index.php
                $this->ctrl = $patharr[0];
                if (isset($patharr[1])) {
                    $this->action = $patharr[1];
                } else {
                    $this->action = 'index';
                }

                // 获取URL中的参数
                $count = count($patharr);
                $i = 2;
                while ($i < $count) {
                    $this->params[$patharr[$i]] = $patharr[$i + 1];
                    $i = $i + 2;
                }
            } else {
                // 没省略index.php
                if (isset($patharr[1])) {
                    $this->ctrl = $patharr[1];
                }
                if (isset($patharr[2])) {
                    $this->action = $patharr[2];
                } else {
                    $this->action = 'index';
                }

                // 获取URL中的参数
                $count = count($patharr);
                $i = 3;
                while ($i < $count) {
                    $this->params[$patharr[$i]] = $patharr[$i + 1];
                    $i = $i + 2;
                }
            }
        } else {
            // 直接只有一级域名而已的话，默认index控制器index方法
            $this->ctrl = 'index';
            $this->action = 'index';
        }
        // var_dump('$params: ', $this->params);
    }

}