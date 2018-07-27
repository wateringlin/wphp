<?php

namespace app\ctrl;

use core\common\db;
use core\log;

class indexCtrl extends \core\render{

    public function index() {
        echo 'index ctrl';
    }

    // 测试数据库连接 http://wphp.com/index.php/index/data
    public function data() {
        $db = new db();
        $sql = 'select * from t_users';
        $res = $db->query($sql);
        var_dump('res: ', $res->fetchAll());
    }

    // 测试页面view渲染 http://wphp.com/index.php/index/render
    public function render() {
        $this->assign('username', 'melvinlin');
        $this->display('index/render.html');
    }

    // 测试日志打印 http://wphp.com/index.php/index/log
    public function log() {
        $log = new log();
        $log->log('this is log', 'log_test');
        echo '成功写入日志';
    }

}