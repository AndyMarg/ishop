<?php

namespace app\controllers;

/**
 * Контроллер для обработки запросов о продукте
 */
class ProductController extends AppController {
    
    public function __construct($route) {
        parent::__construct($route);
    }
    
    public function viewAction() {
        $name = $this->getRoute()['alias'];

        $modelProduct = new \app\models\ProductModel();
        $product = $modelProduct->getProductByName($name);
        $category = $modelProduct->getCategory($product['id']);
        
        $modelProducts = new \app\models\ProductsModel();
        $linked = $modelProducts->getLinkedProducts($product['id']);
        $gallery = $modelProducts->getGallery($product['id']);
        
        $currency = (new \app\models\CurrencyModel())->getCurrency(); 
        
        if (!$product) {
            throw  new \Exception("Страница не найдена", 404);
        }
        
        $this->getView()->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->getView()->setData(compact('product', 'category', 'linked', 'currency', 'gallery'));
        
        // хлебные крошки
        
        // запись в куки запрошенного товара
        
        // просмотренные товары
        
        // галерея
        
        // модификации товара
    }
    
    
}
