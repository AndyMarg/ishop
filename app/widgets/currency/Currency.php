<?php

namespace app\widgets\currency;

use core\base\Application;
use core\base\Widget;

/**
 * Виджет управления валютой
 */
class Currency extends Widget{
    
    public $currencies;
    public $currency;
    
     public function __construct() {
         parent::__construct('currency');
     }
     
     /**
      * Виртуальный метод. Исполнение виджета
      */
    protected function run() {
        $this->currencies = self::getCurrencies();
        $this->currency = self::getCurrency();
        parent::run();
     }
     
     /**
      * Возвращает текущую валюту
      */
     public static function getCurrency() {
         $currencies = self::getCurrencies();
         $currency_name = filter_input(INPUT_COOKIE, 'currency');
         if (isset($currency_name) && key_exists($currency_name, $currencies)) {
             // получить код валюты из куки
             $code = $currency_name;
         } else {
            // получить код валюты из текущего ключа массива валют (отсортирован по базовой валюте)
            $code = key($currencies);    
         }
         $currency = $currencies[$code];
         $currency['code'] = $code;
         return $currency;
    }
     
     /**
      * Возвращает массив валют.
      * @return type
      */
     public static function getCurrencies() {
         $currencies = Application::getStorage()->get('currencies');
         if (!$currencies) {
            $sql = 'select code, title, symbol_left, symbol_right, value, base from currency order by base desc';
            $currencies = \R::getAssoc($sql);
            Application::getStorage()->set('currencies', $currencies);
         }
         return $currencies;
     }
     
}
