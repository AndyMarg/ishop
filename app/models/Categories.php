<?php


namespace app\models;

use core\base\_ModelListDb;

/**
 * Список категорий товаров
 */
class Categories extends _ModelListDb {
    
    public function __construct() {
        $options = [
            'sql'  => "select * from category",
            'class' => 'Category'
        ];
        parent::__construct($options);
    }
   
}
