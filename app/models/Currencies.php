<?php

namespace app\models;

use core\base\_ModelListDb;

/**
 * Список валют
 */
class Currencies extends _ModelListDb {
    
    public function __construct() {
        $options = [
            'sql'  => "select * from currency",
            'class' => 'Currency',
            'storage' => 'currencies'
        ];
        parent::__construct($options);
    }
    
}
