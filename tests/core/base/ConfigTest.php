<?php

namespace core\base;

use core\base\Config;

/**
 *  Тест объекта конфигурации
 */
class ConfigTest extends \PHPUnit\Framework\TestCase {
    
    protected static $config;
    
    protected static $default_config = [];
    protected static $app_config = [];
    protected static $union_config = [];
    
    public static function setUpBeforeClass() {

        // получить и инициализировать объект конфигурации
        self::$config = Config::getInstance();
        self::$config->Init(ROOT, '/config/config_app.json');
        
        // массив конфигурации по цмолчанию
        self::$default_config = self::$config->getDefaultConfigArray();
        // массив конфигурации приложения
        self::$app_config = self::$config->getAppConfigArray();
        // тестовый массив результата сияния конфигурации приложения и конфигурации по умолчания
        self::$union_config = json_decode(file_get_contents(dirname(dirname(__DIR__)) . '/data/config_test.json'), true);
    }

    /**
     * Тестируем слияние дефолтной и пользовательской конфигурации
     */
    public function testConfigMerge() {
        // массив результата сияния конфигурации приложения и конфигурации по умолчания 
        // (слияние происходит в методе Init объекта конфигурации)
        $result = self::$config->getConfigArray();
        // сравнимаем результат итоговой конфигурации с тестовой
        $this->assertEquals($result, self::$union_config);
    }
    
    /**
     * Тестируем доступ к свойствам конфигурации
     */
    public function testConfigProperties() {
        $this-> assertEquals(self::$config->app01, "v_app01");
        $this-> assertEquals(self::$config->default02, "v_default02");
        $this-> assertEquals(self::$config->default03->default03_02, "v_default03_02");
        $this-> assertEquals(self::$config->default05->default05_02->default05_02_02->default05_02_02_01, "v_rewrite05_02_02_01");
    }

}
