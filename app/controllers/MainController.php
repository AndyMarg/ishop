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
        $brands = \R::find('brand', 'limit 3');
        $hits = \R::find('product', "hit = '1' and status = '1' limit 8");
        $this->getView()->setData(compact('brands', 'hits'));
    }
}
