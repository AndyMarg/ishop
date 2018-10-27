<?php

namespace app\models;

/**
 * Модель Валюты
 */
class Currency extends AppModel{
    
    public function __construct($currency) {
        parent::__construct($currency);
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
