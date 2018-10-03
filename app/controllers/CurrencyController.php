<?php

namespace app\controllers;

use core\libs\Utils;

/**
 * Обработчик переключения валют
 */
class CurrencyController extends AppController {
    
    public function changeAction() {
        $currency =  filter_input(INPUT_GET, 'currency');
        if (!empty($currency)) {
            setcookie('currency', $currency, time() + 3600*24*7, '/');
        }
        Utils::redirect();
    }
    
}
