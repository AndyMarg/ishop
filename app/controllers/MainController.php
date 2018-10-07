<?php

namespace app\controllers;

use app\controllers\AppController;
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
        $brands = (new \app\models\BrandModel())->getBrands();
        $hits = (new \app\models\HitProductsModel())->getHitProducts();
        $this->getView()->setData(compact('brands', 'hits'));
    }
}
