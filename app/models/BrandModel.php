<?php

namespace app\models;

/**
 * Модель Брэнда
 */
class BrandModel extends AppModel {
   
    public function __construct() {
        $this->setAttribute([
            'name' => 'brands',
            'sql'  => 'select * from brand limit 3'
        ]);
        parent::__construct();
    }

    public function getBrands() {
        return $this->getAttribute('brands')->getValue();
    }
}
