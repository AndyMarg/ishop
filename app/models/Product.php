<?php

namespace app\models;

/**
 * Товар
 */
class Product extends AppModel {
    
    /**
     * КОНСТРУКТОР
     * @param mix $data Массив данных модели товара или ид модели товара или алиасу товара для получения данных из БД
     */
    public function __construct($data) {
        $options = [
            'sql' => 'select * from product where id = :id',
            'params' => [':id' => $data],
            'sql2' => "select * from product where alias = :alias and status = '1'",
            'params2' => [':alias' => $data]
        ];
        parent::__construct($data, $options);
    }
 
    /**
     * Возвращает список связанных объектов (также доступен как linked)
     * @return ProductsLinked 
     */
    public function getLinked() {
        return new ProductsLinked((int)$this->id);
    }
    
    /**
     * Возвращает объект категории товароа (также доступен как category)
     * @return Category
     */
    public function getCategory() {
        return new Category((int)$this->category_id);
    }
    
    /**
     * Возвращает список рисунков галлереи (также доступен как gallery)
     * @return GalleryImages 
     */
    public function getGallery() {
        return new GalleryImages($this->id);
    }
    
    /**
     * Возвращает список просмотренных товаров (также доступен как viewed)
     * @return ProductsViewed
     */
    public function getViewed() {
        $ids = ProductsViewed::getRecentlyViewed();
        // удаляем ид текущего товара
        $ids = array_diff($ids, [(int)$this->id]);
        if (!empty($ids)) {
            return new ProductsViewed((int)$this->id);
        } else {
            return false;
        }    
    }
    
    /**
     * Возвращает массив объектов категории товаря для представления  в виде "хлебных крошек"
     * @return type array
     */
    public function getBreadcrumbs() {
        $categories = new Categories();
        $category = $categories->search('id', $this->category_id);
        do {
            $result[] = $category;
            $parent_id = $category->parent_id;
            $category = $categories->search('id', $parent_id);
        } while ((int)$parent_id != 0);
        return array_reverse($result);
    }
    
    public function getModifications() {
        return new Modifications($this->id);
    }
}
