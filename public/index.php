<?php

//xdebug_disable();

use core\base\Application;

// автозагрузчик классов от composer
require_once dirname(__DIR__) . '/vendor/autoload.php';

// корень приложения в файловой системе
define('ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));

// Инициализирум приложение. Передаем корневой каталог приложения и json c настройками конфигурации
Application::Init(ROOT, '/config/config_app.json');


