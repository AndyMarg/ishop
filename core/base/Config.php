<?php

namespace core\base;

use core\libs\ArrayAsObject;

/**
 * Управление конфигурацией. Singleton.
 */
final class Config
{
    private static $instance;
    
    private $default_config = [];   // массив данных конфигурации по умолчанию
    private $app_config = [];       // массив данных конфигурации приложения
    private $config = [];           // результирующий массив данных конфигурации
    
    /**
     * Единственный экземпляр конфигурации
     * @return \core\base\Config 
     */
    public static function getInstance(): Config 
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getDefaultConfigArray() {return $this->default_config; }
    public function getAppConfigArray() { return $this->app_config; }
    public function getConfigArray() { return $this->config; }

     /**
     * Делаем недоступным создание, клонирование или создание через десериализацию
     */
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
    
    /**
     * Настраиваем конфигурацию в соответствии с установками в json-файле конфигурации приложения
     * @param string $app_config_file  Файл json с конфигурационными параметрами приложения.
     */
    public function Init(string $app_root, string $app_config_file = "") 
    {
        // считываем конфигурацию по умолчанию
        $file = $app_root . '/core/config_default.json';
        if (!file_exists($file)) {
            throw new \Exception('Not found default config data file: ' . $file);
        }
        $this->default_config = json_decode(file_get_contents($file), true);
        
        // считываем конфигурацию приложения
        if (!empty($app_config_file)) {
            $file = $app_root . $app_config_file;
            if (!file_exists($file)) {
                throw new \Exception('Not found application config data file: ' . $file);
            }
            $this->app_config = json_decode(file_get_contents($file), true);
        }
        
        // перезаписываем конфигурацию по умолчанию конфигурацией приложения
        $this->config = array_replace_recursive($this->default_config, $this->app_config);
    }
    
    /**
     * Доступ в свойству конфигурации
     * 
     * @param type $property
     * @return type
     */
    public function __get($property) {
        $object = new ArrayAsObject($this->config);
        return $object->$property;
    }
    
}
