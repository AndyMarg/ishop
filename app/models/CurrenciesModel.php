<?php

namespace app\models;

/**
 * Вмодель Валюты
 */
class CurrenciesModel extends AppModel {
     
    public function __construct() {
        parent::__construct();
    }

    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setAttribute([
            'name' => 'currencies',
            'sql'  => 'select id, code, title, symbol_left, symbol_right, value, base from currency order by base desc',
            'save' => true
        ]);
        foreach ($this->getAttribute('currencies')->getValue() as $currency) {
            $this->data['currencies'][$currency['code']] = new CurrencyModel($currency);
        }
    }

    /**
     * Установить значение свойства при первом обращении 
     * @param type $name Имя свойства
     */
    protected function setLazyData($name) {
        switch ($name):
            // название категории товара
            case 'currency': 
                $currency_name = filter_input(INPUT_COOKIE, 'currency');
                if (isset($currency_name) && key_exists($currency_name, $this->currencies->asArray())) {
                    // получить код валюты из куки
                    $code = $currency_name;
                } else {
                   // получить код валюты из текущего ключа массива валют (отсортирован по базовой валюте)
                   $code = key($this->currencies->asArray());    
                }
                $currency = $this->currencies->$code;
                $this->data['currency'] = $currency;
                break;
            endswitch;
    }
    
}
