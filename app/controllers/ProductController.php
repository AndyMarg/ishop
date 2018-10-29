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

        $product = new \app\models\Product($name);
        // сохраняем ид просмотренного товара в куке
        $product->setRecentlyViewed();
        
        $currency = (new \app\models\Currencies())->currency; 
        
        if (!$product) {
            throw  new \Exception("Страница не найдена", 404);
        }
        
        $this->getView()->setMeta($product->title, $product->description, $product->keywords);
        $this->getView()->setData(compact('product', 'currency'));
        
        // хлебные крошки
        
        // модификации товара
    }
    
    
}
