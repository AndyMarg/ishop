<?php

namespace app\controllers;

use app\controllers\AppController;
use app\models\Brands;
use app\models\Categories;
use app\models\Currencies;
use app\models\Products;
use core\base\Application;

/**
 * Контроллер по умолчанию
 */
class MainController extends AppController {
    
    public function __construct($route) {
        parent::__construct($route);
    }
    
    public function indexAction() {
        $config = Application::getConfig();
        $this->getView()->setMeta($config->site->shop_name, $config->site->description,$config->site->keywords);
        
        $brands = (new Brands())->brands;
        $products = (new Products())->products;
        $currency =(new Currencies())->currency;
        
        $this->getView()->setData(compact('brands', 'products', 'currency'));
    }
}
