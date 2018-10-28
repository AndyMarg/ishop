<?php

namespace app\models;

/**
 * Модель Продукта
 */
class Product extends AppModel {
    
    public function __construct($product) {
        parent::__construct($product);
    }
    
    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        // создаем основные свойства товара
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
                $this->data['category'] = (new Category())->getCategories()[$this->category_id];
                break;
            // список связанных товаров
            case 'linked': 
                $this->setAttribute([
                    'name' => 'linked',
                    'sql'  => "select p.* from product p join related_product r on r.related_id = p.id where r.product_id = :id limit 3",
                    'params' => array(':id' => $this->id)
                ]);
                foreach ($this->getAttribute('linked')->getValue() as $product) {
                    $this->data['linked'][] = new Product($product);
                }
                break;
            // список рисунков галереи
            case 'gallery': 
                $this->setAttribute([
                    'name' => 'gallery',
                    'sql'  => "select * from gallery where product_id = :id limit 3",
                    'params' => array(':id' => $this->id)
                ]);
                foreach ($this->getAttribute('gallery')->getValue() as $img) {
                    $this->data['gallery'][] = new GalleryImage($img);
                }
                break;
            // список просмотренных товаров
            case 'viewed': 
                $ids = $this->getRecentlyViewed();
                if (empty($ids)) {
                    $this->data['viewed'] = [];
                } else {
                    $this->setAttribute([
                        'name' => 'viewed',
                        'sql'  => "select * from product where id in (:ids) limit 3",
                        'params' => [
                            ':ids' => $ids
                         ]   
                    ]);
                    foreach ($this->getAttribute('viewed')->getValue() as $product) {
                        if ($product['id'] !== $this->id) {
                            $this->data['viewed'][] = new Product($product);
                        }
                    }
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
            'sql'  => "select * from product where alias = :alias and status = '1'",
            'params' => [':alias' => $name]
        ]);
        return $this->getAttribute('product')->getValue()[0];
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
        return $this->getAttribute('product')->getValue()[0];
    }
    
    private function getRecentlyViewed() {
        $cookie_value = filter_input(INPUT_COOKIE, 'recentlyViewed') ?? false;
        return $cookie_value ? explode(',', $cookie_value) : [];
    }
    
    public function setRecentlyViewed() {
        $ids = $this->getRecentlyViewed();
        if (!in_array($this->data['id'], $ids)) {
            $ids[] = $this->data['id'];
            sort($ids);
            setcookie('recentlyViewed', implode(',', $ids), time() + 3600*24*7, '/');
        }
    }
    
}
