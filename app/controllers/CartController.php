<?php

namespace app\controllers;

use app\models\Modification;
use app\models\Product;

/**
 * Контроллер корзины
 */
class CartController extends AppController {
   
    public function addAction() {
        $product_id = (int) filter_input(INPUT_GET, 'id');
        $quantity = (int) filter_input(INPUT_GET, 'quantity');
        $modifier_id = (int) filter_input(INPUT_GET, 'modifier');
       
        $product = new Product($product_id);
        
        die;
        
        $modifier = $modifier_id !== 0 ? new Modification($modifier_id) : false;
        
    }
}
