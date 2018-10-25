<?php

namespace core\libs;

use core\base\Application;

/**
 * Аттрибуn данных
 */
class Attribute {
    
    private $name = '';
    private $value = null;
    private $save = false;
 
    public function __construct(array $opts) {
        if (key_exists('name', $opts)) { $this->name = $opts['name']; }
        if (key_exists('value', $opts)) { $this->value = $opts['value']; }
        if (key_exists('save', $opts)) { $this->save = $opts['save']; }
        
        // если значение не передано в опциях, пробуем получить из хранилища 
        if (empty($this->value) && $this->save) {
             $this->value = Application::getStorage()->get($this->name);
        }
        
        // если значение не передано в опциях и отсутствует в хранилище и задан sql, заполняем значение аттрибута из БД
        if (empty($this->value) && key_exists('sql', $opts)) {
            $this->value = $this->getFromDB($opts['sql'], key_exists('params', $opts) ? $opts['params'] : []);
        }
        // сохраняем значение аттрибута в хранилище, если нужно
        if (!empty($this->value) && $this->save) {
            Application::getStorage()->set($this->name, $this->value);
        }
    }
    
    /**
     * Заполняем значение аттрибута из БД
     * @param string $sql
     * @param type $params
     */
    private function getFromDB(string $sql, $params) {
        if ($this->name === 'currencies') {
            var_dump(Application::getDb()->query($sql, $params));
            var_dump(\R::getAssoc($sql, $params));
        }
        //return \R::getAssoc($sql, $params);
        return \R::getAssoc($sql, $params);
    }
    
    /**
     * Возвращаем значение аттрибута из хранилища или из текущего объекта
     * @return type
     */
    public function getValue() {
        if ($this->save) {
            $this->value = Application::getStorage()->get($this->name);
        }
        return $this->value;
    }
}
