<?php

namespace app\models;

/**
 * Модель категорий
 */
class Categories extends AppModel {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Установить свойства модели при создании (вызывается из конструктора)
     * @param type $item Элемент, идентифицирующий модель (ид, название и т.д.)
     */
    protected function setData($item = null) {
        $this->setProperty([
            'name' => 'categories',
            'sql' => 'select * from category',
            'save' => true,
            'class' => 'Category'
        ]);
    }

    /**
    * Получить объект модели по ИД
    * (может переоапределляться в наследниках)
    * @param type $id ид модели
    */
    public function getById($id) {
        return $this->categories->search('id', $id);
    }
    
}

