<?php

namespace app\models;

/**
 * Модель Валюты
 */

class ProductsModel extends AppModel {
     
    public function __construct() {
        parent::__construct();
    }

    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setAttribute([
            'name' => 'products',
            'sql'  => "select * from product where hit = :hit and status = :status limit 8",
            'params' => array(':hit' => '1', ':status' => '1')
        ]);
        foreach ($this->getAttribute('products')->getValue() as $product) {
            $this->data['products'][] = new ProductModel($product);
        }
    }

}

