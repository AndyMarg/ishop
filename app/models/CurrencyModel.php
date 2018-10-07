<?php

namespace app\models;

/**
 * Вмодель Валюты
 */
class CurrencyModel extends AppModel {
     
    public function __construct() {
        $this->setAttribute([
            'name' => 'currencies',
            'sql'  => 'select code, title, symbol_left, symbol_right, value, base from currency order by base desc',
            'save' => true
        ]);
        $this->setAttribute([
            'name' => 'currency',
            'value' => $this->getCurrency()
        ]);
        parent::__construct();
    }

    /**
    * Возвращает текущую валюту
    */
    public function getCurrencies() {
        return $this->getAttribute('currencies')->getValue();
    }

    /**
     * Возвращает текущую валюту
     */
    public function getCurrency() {
        $currencies = $this->getCurrencies();
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
    
}
