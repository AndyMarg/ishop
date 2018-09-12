<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

//$i = require_once dirname(__DIR__) . '/config/config_data.php'; 

$a = new \core\base\Application('test config');
var_dump($a);

//var_dump($a->config);