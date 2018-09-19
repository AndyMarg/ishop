<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use core\base\Application;

//xdebug_disable();

// корень приложения
define('ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));

// Инициализирум приложение. Передаем корневой каталог приложения и json c настройками конфигурации
Application::Init(ROOT, '/config/config_app.json');


