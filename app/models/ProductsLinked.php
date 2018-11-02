<?php

namespace app\models;

/**
 * Модель списка связанных товаров
 */
class ProductsLinked extends Products {
    
    private $id;
    
    public function __construct($id) {
        $this->id = $id;
        parent::__construct();
    }

    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setProperty([
            'name' => 'products',
            'sql'  => "select p.* from product p join related_product r on r.related_id = p.id where r.product_id = :id limit 3",
            'params' => array(':id' => (int)$this->id),
            'class' => 'Product'
        ]);
    }
    
}



