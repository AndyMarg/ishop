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
        $modelProduct = new \app\models\ProductModel();
        $name = $this->getRoute()['alias'];
        $product = $modelProduct->getProductByName($name);
        $category = $modelProduct->getCategory($product['id']);
        $linked = (new \app\models\ProductsModel())->getLinkedProducts($product['id']);
        $currency = (new \app\models\CurrencyModel())->getCurrency(); 
        
        if (!$product) {
            throw  new \Exception("Страница не найдена", 404);
        }
        $this->getView()->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->getView()->setData(compact('product', 'category', 'linked', 'currency'));
        
        // хлебные крошки
        
        // связанные товары
        
        // запись в куки запрошенного товара
        
        // просмотренные товары
        
        // галерея
        
        // модификации товара
    }
    
    
}
