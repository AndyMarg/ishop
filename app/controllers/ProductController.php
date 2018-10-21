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

        $product = new \app\models\ProductModel($name);
        $currency = (new \app\models\CurrenciesModel())->currency; 
        
        if (!$product) {
            throw  new \Exception("Страница не найдена", 404);
        }
        
        $this->getView()->setMeta($product->title, $product->description, $product->keywords);
        $this->getView()->setData(compact('product', 'currency'));
        
        // хлебные крошки
        
        // запись в куки запрошенного товара
        
        // просмотренные товары
        
        // модификации товара
    }
    
    
}
