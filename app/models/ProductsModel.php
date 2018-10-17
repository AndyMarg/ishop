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
    * Возвращает массив топовых продуктов
    */
    public function getHitProducts() {
        $this->setAttribute([
            'name' => 'hit_products',
            'sql'  => "select * from product where hit = :hit and status = :status limit 8",
            'params' => array(':hit' => '1', ':status' => '1')
        ]);
        return $this->getAttribute('hit_products')->getValue();
    }

    /**
    * Возвращает массив связанных продуктов
    */
    public function getLinkedProducts(int $product_id) {
        $this->setAttribute([
            'name' => 'linked_products',
            'sql'  => "select p.* from product p join related_product r on r.related_id = p.id where r.product_id = :id limit 3",
            'params' => array(':id' => $product_id)
        ]);
        return $this->getAttribute('linked_products')->getValue();
    }
    
}

