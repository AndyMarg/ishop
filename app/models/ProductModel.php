<?php

namespace app\models;

/**
 * Модель Продукта
 */
class ProductModel extends AppModel {
    
    public function __construct($product) {
        if (gettype($product) === 'integer') {
            $this->data = $this->getProductById($product);
        } else {
            $this->data = $this->getProductByName($product);
        }
        $this->data['category'] = $this->getCategory();
        parent::__construct();
    }

    /**
    * Возвращает информацию о товаре по алиасу
    */
    private function getProductByName($name) {
        $this->setAttribute([
            'name' => 'product',
            'sql'  => "select * from product where alias = ? and status = '1'",
            'params' => [$name]
        ]);
        $data = $this->getAttribute('product')->getValue();
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
    private function getProductById(int $id) {
        $this->setAttribute([
            'name' => 'product',
            'sql'  => "select * from product where id = :id",
            'params' => [':id' => $id]
        ]);
        $data = $this->getAttribute('product')->getValue();
        $product = array_shift($data);
        $product['id'] = $id;
        return $product;
    }

    /**
     * Возвращает категорию товара
     */
    private function getCategory() {
        return (new CategoryModel())->getCategories()[$this->category_id];
    }
    
}
