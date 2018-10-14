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
        $product = (new \app\models\ProductModel($name))->getProduct();
        if (!$product) {
            throw  new \Exception("Страница не найдена", 404);
        }
        $this->getView()->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->getView()->setData(compact('product'));
        
        // хлебные крошки
        
        // связанные товары
        
        // запись в куки запрошенного товара
        
        // просмотренные товары
        
        // галерея
        
        // модификации товара
    }
    
    
}
