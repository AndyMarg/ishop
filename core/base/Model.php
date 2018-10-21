<?php

namespace core\base;

use core\libs\ArrayAsObject;
use core\libs\Attribute;

/**
 * Абстрактный класс модели
 */
abstract class Model {

    // массив для доступа через магические методы
    protected $data = [];
    
    // поля данных (вероятно из базы)
    private $attributes = [];
    // ошибки
    private $errors = [];
    // ошибки валидации
    private $rules = [];
    
    /**
     * КОНСТРУКТОР
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    public function __construct($item = null) {
        $this->setData($item);
    }
    
    /**
     * Установить свойства модели при создании (вызывается из конструктора(
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {}
    
    /**
     * Установить значение свойства при первом обращении 
     * @param type $name Имя свойства
     */
    protected function setLazyData($name) {}
    
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

    /**
     * Доступ в свойству модели
     * 
     * @param type $property
     * @return type
     */
    public function __get($property) {
        if (!key_exists($property, $this->data)) {
            $this->setLazyData($property);
        }
        if (key_exists($property, $this->data)) {
            $object = new ArrayAsObject($this->data);
            return $object->$property;
        }
    }
    
}
