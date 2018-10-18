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
        //var_dump($product->id); die;
        
        //$product = $modelProduct->getProductByName($name);
        //$category = $modelProduct->getCategory($product['id']);
        $category = $product->getCategory($product->id);
        
        
        $product = new \app\models\ProductsModel();
        //$linked = $modelProducts->getLinkedProducts($product['id']);
        $linked = $product->getLinkedProducts($product->id);
        //$gallery = $modelProducts->getGallery($product['id']);
        $gallery = $product->getGallery($product->id);
        
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
