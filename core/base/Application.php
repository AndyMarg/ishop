<?php

namespace core\base;

/**
 * Класс приложения.
 * Только статические методы.
 */
class Application {

    /**
     * Вернуть объект конфигурации приложения
     * 
     * @return type Congig class
     */
    public static function getConfig() {
        return Config::getInstance();
    }
    
    /**
     * Вернуть URL корня приложения
     * @return type string 
     */
    public static function getRootURL() {
        return 'http://' . filter_input(INPUT_SERVER, 'SERVER_NAME');
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