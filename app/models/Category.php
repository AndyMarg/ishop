<?php

namespace app\models;

/**
 * Модель каткгории товара
 */
class Category extends AppModel {
    
        public function __construct($category) {
            parent::__construct($category);
    }
    
    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        switch (gettype($item)):
            case 'array':
                $this->data = $item;
        endswitch;
    }

}
