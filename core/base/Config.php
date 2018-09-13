<?php

namespace core\base;

/**
 * Управление конфигурацией. Singleton.
 */
final class Config
{
    private static $instance;

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

    /**
     * Делаем недоступным создание, клонирование или создание через десериализацию
     */
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
    
    /**
     * Настраиваем конфигурацию в соответствии с установками в json-файле
     * @param string $config_file  Файл json с конфигурационными параметрами.
     */
    public function Init(string $config_file) 
    {
        // считываем конфигурацию по умолчанию
        $file = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'). '/core/config_data.json';
        if (!file_exists($file)) {
            throw new \Exception('Not found default config data file: ' . $file);
        }
        $arr = json_decode(file_get_contents($file), true);
        var_dump($arr);
        
       
//        if (!file_exists($file)) {
//            throw new Exception('Not found config data file: ' . $config_file);
//        }
    }
    
    
}
