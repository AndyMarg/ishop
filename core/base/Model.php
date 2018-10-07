<?php

namespace core\base;

use core\libs\Attribute;

/**
 * Абстрактный класс модели
 */
abstract class Model {

    // поля данных (вероятно из базы)
    private $attributes = [];
    // ошибки
    private $errors = [];
    // ошибки валидации
    private $rules = [];
    
    public function __construct() {
        
    }
    
    /**
     * Устанавливаем значение аттрибута
     * @param array $opts
     */
    protected function setAttribute(array $opts) {
        $this->attributes[$opts['name']] = new Attribute($opts);
    }

    /**
     * Возвращаем значение аттрибута
     * @param type $name
     * @return type
     */    
    protected function getAttribute($name) {
        return $this->attributes[$name];
    }

}
