<?php

namespace core\base;

/**
 * Базовый класс View
 */
class View {
    
    // контроллер - владелец вида
    private $controller;
    // массив переменных для view
    private $data = [];
    // массив метаданных для view
    private $meta = ['title' => '', 'decription' => '', 'keywords' => ''];
    
    public function __construct(Controller $controller) {
        $this->controller = $controller;
    }
    
    public function getController() { return $this->controller; }
    public function setController(Controller $controller) { $this->controller = $controller; }     

    /**
     * Установить массив переменных для view
     * @param type $data
     */
    public function setData($data) { $this->data = $data; }
    
    /**
     * Установить метаданные
     * @param string $title
     * @param string $decription
     * @param string $keywords
     */
    public function setMeta(string $title = '', string $decription = '', string $keywords = '') {
        $this->meta['title'] = $title;
        $this->meta['description'] = $decription;
        $this->meta['keywords'] = $keywords;
    }
    
    
}
