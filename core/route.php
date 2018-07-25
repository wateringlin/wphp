<?php
/**
 * 路由控制
 */

namespace core;

class route {

    public $ctrl;
    public $action;

    public function __construct() {
        // echo 'route is ready';
        /**
         * 1、隐藏index.php
         * 2、获取URL中的控制器和方法
         */
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            var_dump('$_SERVER: ', $_SERVER['REQUEST_URI']);
            var_dump('trim($path): ', trim($path, '/'));
            // index/index/id/01/name/dejan/sex/man
            // [0]/[1] /[2]/[3]/[4] / [5] /[6]/[7]
            $patharr = explode('/', trim($path, '/'));
            // p('$patharr: ', $patharr);exit;

            if (isset($patharr[0])) {
                if ($patharr[0] != 'index.php') {
                    // 省略了index.php
                    $this->ctrl = $patharr[0];
                    if (isset($patharr[1])) {
                        $this->action = $patharr[1];
                    } else {
                        $this->action = 'index';
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
                }
            } else {
                // 直接只有一级域名而已的话，默认index控制器index方法
                $this->ctrl = 'index';
                $this->action = 'index';
            }
            p('11111', $this->ctrl, $this->action);
        }
    }

}