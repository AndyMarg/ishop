<?php

namespace app\widgets\currency;

use app\models\CurrencyModel;
use core\base\Widget;

/**
 * Виджет управления валютой
 */
class Currency extends Widget{
    
     public function __construct() {
        parent::__construct('currency');
     }
     
     /**
      * Виртуальный метод. Исполнение виджета
      */
    protected function run() {
        $model = new CurrencyModel();
        $currencies = $model->getCurrencies();
        $currency = $model->getCurrency();
        $this->setData(compact('currencies', 'currency'));
        parent::run();
     }
     
}
