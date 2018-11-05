<?php

namespace core\base;

use core\libs\IteratorBase;
use IteratorAggregate;

/**
 * Список моделей
 */
class _ModelList implements IteratorAggregate {
    
    private $items = [];   // массив объектов моделей
    
    /**
     * КОНСТРУКТОР
     * @param array $source Массив с исходными данными объектов модели
     * @param string $class Класс модели
     */
    public function __construct(array $source, string $class) {
        $className = str_replace('/', '\\',  Application::getConfig()->dirs->models . '/' .  $class);
        foreach ($source as $item) {
            $this->items[] = new $className($item);
        }
    }
    
    /**
     * Возвращает итератор для доступа к объекту как к массиву
     * @return IteratorBase
     */
    public function getIterator() {
        return new IteratorBase($this->items);
    }
    
    /**
     * Поиск объекта модели в списке
     * @param string $name Аттрибут объекта модели
     * @param type $value Значание аттрибута объекта 
     * @return Объект модели, если найден, иначе false
     */
    public function search(string $name, $value) {
    foreach ($this->items as $item) {
        if($item->$name == $value) {
            return $item;
        }
    }
    return false;
}

    /**
     * Получить объект модели по индексу
     * @param type $index
     * @return type
     */
    public function get($index) {
        return $this->items[$index];
    }
    
    /**
     * true, если список пуст, иначе false
     * @return type
     */
    public function is_empty() {
        return empty($this->items);
    }
    
    /**
     * Количество объектов в списке
     * @return type
     */
    public function count() {
        return count($this->items);
    }

}
