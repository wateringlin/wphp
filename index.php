<?php
/**
 * 入口文件
 * 1、定义常亮
 * 2、加载函数库
 * 3、启动框架
 */
define('WPHP', realpath('./')); // 获取项目所在根目录
define('CORE', WPHP.'/core'); // 核心文件所在目录
define('APP', WPHP.'/app'); // 应用文件所在目录

define('DEBUG', 'true'); // 是否开启调试

if (DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

include CORE.'/common/function.php'; // 引人全局函数

include CORE.'/wphp.php'; // 引人核心文件

include CORE.'/autoload.php'; // 引人自动加载类库文件

spl_autoload_register('\core\autoload::load');
$route = new \core\route();

\core\wphp::run();
