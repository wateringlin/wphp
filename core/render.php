<?php

namespace core;

class render {

    public $params = array();

    public function assign($name, $value) {
        $this->params[$name] = $value;
    }

    public function display($file) {
        $file = APP.'/view/'.$file; // 组装视图文件的路径
        if (is_file($file)) {
            extract($this->params); // 把数组变成变量
            include $file;
        }
    }

}