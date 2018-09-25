<?php

namespace app\controllers;

use core\base\Controller;

/**
 * Контроллер по умолчанию
 */
class MainController extends Controller {
    
    public function indexAction() {
        var_dump(__METHOD__);
    }
}
