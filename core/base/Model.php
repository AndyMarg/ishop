<?php

namespace core\base;

/**
 * Базовый класс модели
 */

abstract class Model {
    
    private $data = [];  // данные модели
    
    /**
     * КОНСТРУКТОР
     * @param array $data Массив данных модели
     */
    public function __construct(array $data = null) {
        $this->data = $data;
    }
    
    /**
     * Доступ к несуществующему свойству объекта
     * @param type $property Имя свойства или часть имени публичного метода get{$Property}()
     * @return mix Значение свойства (элемента массива, где ключ - имя свойства  результат вызова метода 
     * @throws \Exception Если такого элемента массива не существует
     */
    public function __get($property) {
        $method = 'get' . ucfirst($property);
        if (!array_key_exists($property, $this->data) && !method_exists($this, $method)) {
            throw new \Exception("Not found property \"{$property}\" or public method \"{$method}\"");
        } 
        if (isset($this->data[$property])) {
            return $this->data[$property];
        } elseif (method_exists($this, $method)) {
            return $this->$method();
        }
    }
    
    public function __isset($property) {
        return isset($this->data[$property]);
    }

    public function __unset($property) {
        unset($this->data[$property]);
    }
    
    /**
     * Данные модели в виде массива
     * @return type
     */
    public function asArray() {
        return $this->data;
    }
    
}
