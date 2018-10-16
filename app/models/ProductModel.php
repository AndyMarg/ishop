<?php

namespace app\models;

/**
 * Модель Продукта
 */
class ProductModel extends AppModel {
    
    private $id;
     
    public function __construct() {
        parent::__construct();
    }

    /**
    * Возвращает информацию о товаре по алиасу
    */
    public function getProductByName($name) {
        $this->setAttribute([
            'name' => 'product_by_name',
            'sql'  => "select * from product where alias = ? and status = '1'",
            'params' => [$name]
        ]);
        $data = $this->getAttribute('product_by_name')->getValue();
        $id = array_keys($data)[0];
        $product = array_shift($data);
        $product['id'] = $id;
        return $product;
    }

    /**
     * Возвращает информацию о товаре по id
     * @param int $id
     * @return int
     */
    public function getProductById(int $id) {
        $this->setAttribute([
            'name' => 'product_by_id',
            'sql'  => "select * from product where id = :id",
            'params' => [':id' => $id]
        ]);
        $data = $this->getAttribute('product_by_id')->getValue();
        $product = array_shift($data);
        $product['id'] = $id;
        return $product;
    }

    /**
     * Возвращает категорию товара
     */
    public function getCategory($product_id) {
        $product = $this->getProductById($product_id);
        return (new CategoryModel())->getCategories()[$product['category_id']];
    }
}
