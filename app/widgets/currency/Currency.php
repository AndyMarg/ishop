<?php

namespace app\widgets\currency;

use core\base\Application;
use core\base\Widget;

/**
 * Виджет управления валютой
 */
class Currency extends Widget{
    
     public function __construct() {
         parent::__construct('currency');
     }
     
     protected function run() {
         $this->getHtml();
     }
     
     public static function getCurrency() {
     }
     
     public static function getCurrencies() {
         $currencies = Application::getStorage()->get('currencies');
         if (!$currencies) {
            $sql = 'select code, title, symbol_left, symbol_right, value, base from currency order by base desc';
            $currencies = \R::getAssoc($sql);
            Application::getStorage()->set('currencies', $currencies);
         }
         return $currencies;
     }
     
     private function getHtml() {
         
     }
    
}
