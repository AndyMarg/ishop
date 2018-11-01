<?php

namespace app\models;

/**
 * Модель Брэнда
 */
class Brands extends AppModel {
   
    public function __construct() {
        parent::__construct();
    }

    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setProperty([
            'name' => 'brands',
            'sql'  => 'select * from brand limit 3',
            'class' => 'Brand'
        ]);
    }
    
}
