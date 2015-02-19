<?php
    require_once __DIR__ . '/../../vendor/php-activerecord/php-activerecord/ActiveRecord.php';
    $cfg = ActiveRecord\Config::instance();
    $cfg->set_model_directory(__DIR__.'/../Models/');
    $cfg->set_connections(array('development' =>
          'mysql://user:pass@localhost/mydb?charset=utf8'));