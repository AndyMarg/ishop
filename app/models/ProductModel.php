<?php

namespace app\models;

/**
 * Модель Продукта
 */
class ProductModel extends AppModel {
    
    private $id;
     
    public function __construct($name) {
        $this->setAttribute([
            'name' => 'product',
            'sql'  => "select * from product where alias = ? and status = '1'",
            'params' => [$name]
        ]);
        parent::__construct();
    }

    /**
    * Возвращает информацию о продукте
    */
    public function getProduct() {
        $data = $this->getAttribute('product')->getValue();
        $id = array_keys($data)[0];
        $product = array_shift($data);
        $product['id'] = $id;
        return $product;
    }

    
}
