<?php

namespace app\models;

/**
 * Модель категорий
 */
class CategoryModel extends AppModel {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Возвращает массив категорий.
     * Индексы - ид категорий
     * @return type
     */
    public function getCategories() {
        $this->setAttribute([
            'name' => 'categories',
            'sql' => 'select * from category',
            'save' => true
        ]);
        foreach ($this->getAttribute('categories')->getValue() as $value) {
            $result[$value['id']] = $value;
        }
        return $result;
    }
}
