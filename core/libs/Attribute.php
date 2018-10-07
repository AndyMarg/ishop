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
        // сохраняем значение аттрибута в хранилище, если нужно
        if ($this->save) {
            Application::getStorage()->set($this->name, $this->value);
        }
        // заполняем значение аттрибута из БД, если задан sql
        if (key_exists('sql', $opts)) {
            $this->getFromDB($opts['sql'], key_exists('params', $opts) ? $opts['params'] : []);
        }
    }
    
    /**
     * Заполняем значение аттрибута из БД
     * @param string $sql
     * @param type $params
     */
    private function getFromDB(string $sql, $params) {
            $this->value = \R::getAssoc($sql, $params);
            // сохраняем в хранилище, если нужно
            if ($this->save) {
                Application::getStorage()->set($this->name, $this->value);
            }
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
