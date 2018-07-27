<?php

namespace core;

class config {

    public function get($name, $file) {
        /**
         * 1、判断文件是否存在
         * 2、判断配置是否存在
         */
        $file_path = CONFIG.'/'.$file.'.php'; // 组装配置文件的路径
        if (is_file($file_path)) {
            $config = include $file_path;
            if (isset($config[$name])) {
                return $config[$name];
            } else {
                throw new \Exception('没有配置项'.$name);
            }
        } else {
            throw new \Exception('找不到配置文件'.$file);
        }
    }

    public function all($file) {
        $file_path = CONFIG.'/'.$file.'.php';
        if (is_file($file_path)) {
            $config = include $file_path;
            return $config;
        } else {
            throw new \Exception('找不到配置文件'.$file);
        }
    }

}