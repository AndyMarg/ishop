<?php

namespace core\base;

use core\libs\TSingleton;

/**
 * Хранилище постоянных объектов. Singleton
 */
class Storage {
    
    use TSingleton;
    
    private $data = [];
    
    /**
     * Установит значение элемента
     * @param type $name
     * @param type $value
     */
    public function set($name, $value) {
        $this->data[$name] = $value;
    }
    
    /**
     * Получить значение элемента
     * @param type $name
     * @return boolean
     */
    public function get($name) {
        if (key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return false;
    }
    
    /**
     * Удилить элемент
     * @param type $name
     */
    public function remove($name) {
        unset($this->data[$name]);
    }
    
    /**
     * Очистить хранилище
     * @param type $param
     */
    public function clear($param) {
        foreach ($this>data as $name => $value) {
            remove($this->data[$name]);
        }
    }
    
    /**
     * Получить все элементы
     * @return type
     */
    public function getAll() {
        return $this->data;
    }
}
