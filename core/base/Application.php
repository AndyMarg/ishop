<?php

namespace core\base;

/**
 * Класс приложения.
 * Только статические методы.
 */
class Application {

    public static function getConfig() {
        return Config::getInstance();
    }
    
    /**
     * Инициализирует приложение.
     * 
     * @param string $app_config_file Файл json с конфигурационными параметрами.
     */
    public static function Init(string $app_root, string $app_config_file = "") 
    {
        // создаем объект конфигурации
        $config = Config::getInstance();
        $config->Init($app_root, $app_config_file);
    }

} 