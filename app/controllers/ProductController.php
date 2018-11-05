<?php

namespace app\controllers;

use app\models\Currencies;
use app\models\Currency;
use app\models\Product;
use app\models\ProductsViewed;
use Exception;

/**
 * Контроллер для обработки запросов о продукте
 */
class ProductController extends AppController {
    
    public function __construct($route) {
        parent::__construct($route);
    }
    
    public function viewAction() {
        $name = $this->getRoute()['alias'];

        $product = new Product($name);
        if (!$product) {
            throw  new Exception("Страница не найдена", 404);
        }
        
        // сохраняем ид просмотренного товара в куке
        ProductsViewed::setRecentlyViewed($product->id);
        
        // получить текущую валюту
        $currencies = new Currencies();
        $current_code = Currency::getCurrentCode();
        $currency = ($current_code) ? $currencies->search('code', $current_code) : $currencies->get(0);
        
        $this->getView()->setMeta($product->title, $product->description, $product->keywords);
        $this->getView()->setData(compact('product', 'currency'));
        
        // хлебные крошки
        
        // модификации товара
    }
    
    
}
