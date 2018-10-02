<?php

namespace core\base;

use core\libs\Utils;

/**
 * Класс приложения.
 * Только статические методы.
 */
class Application {
    
    private static $router;
    private static $db;
    private static $storage;

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
     * Вернуть объект хранилища
     * @return type
     */
    public static function getStorage() {
        return Storage::getInstance();
    }
    
    /**
     * Вернуть объект менеджера БД
     * @return type string 
     */
    public static function getDb() { 
        return self::$db;  
    }

    /**
     * Вернуть объект роутера
     * @return type object Router
     */
    public static function getRouter() { 
        return self::$router; 
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
        
        // инициализируем обработчик ошибок
        new ErrorHandler();
        
        // стартуем сессию
        session_start();

        // подключаемся к базе
        self::$db = Db::getInstance();
        self::$db->Init();
        
        // инициализируем роутер
        self::$router = Router::getInstance();
        self::$router->Init();
        // передаем запрос на обработку маршрутизатору
        self::$router->dispatch(Utils::getUrl());
    }
    
} 