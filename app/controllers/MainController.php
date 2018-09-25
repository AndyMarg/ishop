<?php

namespace app\controllers;

use app\controllers\AppController;

/**
 * Контроллер по умолчанию
 */
class MainController extends AppController {
    
    public function __construct($route) {
        parent::__construct($route);
    }
    
    public function indexAction() {
        var_dump(__METHOD__);
    }
}
