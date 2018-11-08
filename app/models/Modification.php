<?php

namespace app\models;

/**
 * Модификация товара
 */
class Modification extends AppModel{

   /**
     * КОНСТРУКТОР
     * @param mix $data Массив данных модели модификации товара или ид модели модификации товара для получения данных из БД
     */
    public function __construct($data) {
        $id = gettype($data) === 'integer' ? $data : NULL;
         $options = [
            'sql' => 'select * from modification where id = :id',
            'params' => [':id' => $id]
        ];
        parent::__construct($data, $options);
    }
    
}
