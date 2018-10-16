<?php

namespace app\models;

/**
 * Модель Брэнда
 */
class BrandModel extends AppModel {
   
    public function __construct() {
        parent::__construct();
    }

    public function getBrands() {
        $this->setAttribute([
            'name' => 'brands',
            'sql'  => 'select * from brand limit 3'
        ]);
        return $this->getAttribute('brands')->getValue();
    }
}
