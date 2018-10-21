<?php

namespace app\widgets\currency;

use app\models\CurrenciesModel;
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
        $model = new CurrenciesModel();
        $currencies = $model->currencies;
        $currency = $model->currency;
        $this->setData(compact('currencies', 'currency'));
        parent::run();
     }
     
}
