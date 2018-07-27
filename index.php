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

define('CONFIG', WPHP.'/config'); // 配置文件所在目录
define('LOG', WPHP.'/log'); // 日志文件所在目录

define('DEBUG', 'true'); // 是否开启调试

if (DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

date_default_timezone_set('Asia/Shanghai');

include CORE.'/common/function.php'; // 引人全局函数

include CORE.'/wphp.php'; // 引人核心文件

include CORE.'/autoload.php'; // 引人自动加载类库文件

spl_autoload_register('\core\autoload::load'); // 自动执行load函数去引人相关类文件
$route = new \core\route(); // 实例化\core\route，触发自动加载函数

// 调用控制器
$ctrl = $route->ctrl;
$action = $route->action;
$params = $route->params;
$ctrl_file = APP.'/ctrl/'.$ctrl.'Ctrl.php'; // 组装控制器文件路径
$ctrl_class = '\\app\\ctrl\\'.$ctrl.'Ctrl'; // 组装控制器命名空间路径
if (is_file($ctrl_file)) {
    include $ctrl_file;
    $ctrl_obj = new $ctrl_class;
    $ctrl_obj->$action(); // 执行控制器相关方法，业务代码逻辑在此执行
} else {
    header('Content-Type: text/html;chartset=utf-8');
    throw new \Exception('找不到控制器'.$ctrl_file);
}

\core\wphp::run();
