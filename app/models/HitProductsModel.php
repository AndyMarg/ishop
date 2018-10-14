<?php

namespace app\models;

/**
 * Модель Валюты
 */
class HitProductsModel extends AppModel {
     
    public function __construct() {
        $this->setAttribute([
            'name' => 'hit_products',
            'sql'  => "select * from product where hit = '1' and status = '1' limit 8"
        ]);
        parent::__construct();
    }

    /**
    * Возвращает массив топовых продуктов
    */
    public function getHitProducts() {
        return $this->getAttribute('hit_products')->getValue();
    }

}
