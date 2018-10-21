<?php

namespace app\models;

/**
 * Модель Продукта
 */
class ProductModel extends AppModel {
    
    public function __construct($product) {
        parent::__construct($product);
    }
    
    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        switch (gettype($item)):
            case 'integer':
                $this->data = $this->getProductById($item);
                break;
            case 'string':
                 $this->data = $this->getProductByName($item);
                break;
            case 'array':
                $this->data = $item;
        endswitch;
    }

    /**
     * Установить значение свойства при первом обращении 
     * @param type $name Имя свойства
     */
    protected function setLazyData($name) {
        switch ($name):
            // название категории товара
            case 'category': 
                $this->data['category'] = (new CategoryModel())->getCategories()[$this->category_id];
                break;
            // список связанных товаров
            case 'linked': 
                $this->setAttribute([
                    'name' => 'linked',
                    'sql'  => "select p.* from product p join related_product r on r.related_id = p.id where r.product_id = :id limit 3",
                    'params' => array(':id' => $this->id)
                ]);
                foreach ($this->getAttribute('linked')->getValue() as $id => $product) {
                    $product['id'] = $id;
                    $this->data['linked'][$id] = new ProductModel($product);
                }
                break;
            // список рисунков галереи
            case 'gallery': 
                $this->setAttribute([
                    'name' => 'gallery',
                    'sql'  => "select * from gallery where product_id = :id limit 3",
                    'params' => array(':id' => $this->id)
                ]);
                foreach ($this->getAttribute('gallery')->getValue() as $id => $img) {
                    $product['id'] = $id;
                    $this->data['gallery'][$id] = new GalleryImageModel($img);
                }
                break;
            endswitch;
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

}
