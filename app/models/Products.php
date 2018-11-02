<?php

namespace app\models;

/**
 * Модель списка товаров
 */

class Products extends AppModel {
     
    public function __construct() {
        parent::__construct();
    }

    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setProperty([
            'name' => 'products',
            'sql'  => "select * from product where hit = :hit and status = :status limit 8",
            'params' => array(':hit' => '1', ':status' => '1'),
            'class' => 'Product'
        ]);
    }
    
}    
