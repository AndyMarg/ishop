<?php

namespace app\models;

/**
 * Модель рисунка галереи
 */
class Brand extends AppModel {
    
        public function __construct($brand) {
            parent::__construct($brand);
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
