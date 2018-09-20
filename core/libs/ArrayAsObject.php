<?php

namespace core\libs;

/**
 * Массив как объект. Доступ с несущестующему свойству через __SET
 */
class ArrayAsObject {

    private $array;
    
    public function __construct(array $array) {
        $this->array = $array;
    }

    /**
     * Доступ к несуществующему свойству объекта
     * 
     * @param type $property Имя свойства
     * @return mix Массив как объект (если элемент массива сам по себе массив) или значение элемента
     * @throws \Exception Если такого элемента массива не существует
     */
    public function __get($property) {
        if (!array_key_exists($property, $this->array)) {
            throw new \Exception('Not found property: ' . $property);
        } else {
            if(is_array($this->array[$property])) {
                return new ArrayAsObject($this->array[$property]);
            } else {
                return $this->array[$property];
            }    
        }
    }
    
    public function __isset($property) 
    {
        return isset($this->array[$property]);
    }

    public function __unset($property) 
    {
        unset($this->array[$property]);
    }
    
}