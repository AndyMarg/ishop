<?php

namespace app\models;

/**
 * Категория товара
 */
class Category extends AppModel{

   /**
     * КОНСТРУКТОР
     * @param mix $data Массив данных модели категории или ид модели категории для получения данных из БД
     */
    public function __construct($data) {
        $id = gettype($data) === 'integer' ? $data : NULL;
         $options = [
            'sql' => 'select * from category where id = :id',
            'params' => [':id' => $id]
        ];
        parent::__construct($data, $options);
    }
    
}
