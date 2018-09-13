<?php

namespace core\base;

/**
 * Класс приложения.
 * Только статические методы.
 */
class Application {

    // объект класса Config конфигурации приложения
    private static $config;

    public static function getConfig() {
        return self::$config;
    }
    
    /**
     * Инициализирует приложение.
     * 
     * @param string $config_file Файл json с конфигурационными параметрами.
     */
    public static function Init(string $config_file) 
    {
        // создаем объект конфигурации
        $config = self::$config = Config::getInstance();
        $config->Init($config_file);
    }
    

} 