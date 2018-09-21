<?php

use core\base\Application;

// автозагрузчик классов от composer
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Инициализирум приложение. Передаем корневой каталог приложения и json c настройками конфигурации
Application::Init(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'), '/config/config_app.json');



