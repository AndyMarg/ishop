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
    // шаблон html
    private $layout;
    
    public function __construct(Controller $controller, $layout = '') {
        $this->controller = $controller;
        if ($layout ===  false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ? : Application::getConfig()->defaults->layout;
        }
    }
    
    public function getController() { return $this->controller; }
    public function setController(Controller $controller) { $this->controller = $controller; }     

    public function getLayout() { return $this->layout; }
    public function setLayout($layout) { $this->layout = $layout; }

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
