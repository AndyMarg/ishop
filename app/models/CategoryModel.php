<?php

namespace app\models;

/**
 * Модель категорий
 */
class CategoryModel extends AppModel {
    
    public function __construct() {
        $this->setAttribute([
            'name' => 'categories',
            'sql' => 'select * from category',
            'save' => true
        ]);
        parent::__construct();
    }
    
    /**
     * Возвращает массив категорий
     * @return type
     */
    public function getCategories() {
        return $this->getAttribute('categories')->getValue();
    }
}
