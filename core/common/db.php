<?php
namespace core\common;

use core\config;

class db extends \PDO {

    public function __construct() {
        $config = config::all('db_config');
        $dsn = $config['DSN'];
        $username = $config['USER'];
        $password = $config['PASSWORD'];
        try {
            parent::__construct($dsn, $username, $password);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

}