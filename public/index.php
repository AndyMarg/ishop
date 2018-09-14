<?php

use core\base\Application;

require_once dirname(__DIR__) . '/vendor/autoload.php';

//xdebug_disable();

// Инициализирум приложение. Передаем json c настройками конфигурации
Application::Init('/config/config_app.json');



