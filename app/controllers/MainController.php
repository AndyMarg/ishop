<?php

namespace app\controllers;

use app\controllers\AppController;
use app\models\Brands;
use app\models\Currencies;
use app\models\Currency;
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

        $brands = new Brands();
        $products = new Products();
        
        // текущая вылюта
        $currencies = new Currencies();
        $current_code = Currency::getCurrentCode();
        $currency = ($current_code) ? $currencies->search('code', $current_code) : $currencies->get(0);
        
        $this->getView()->setData(compact('brands', 'products', 'currency'));
    }
}
