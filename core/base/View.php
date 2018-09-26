<?php

namespace core\base;

use core\libs\Utils;

/**
 * Базовый класс View
 */
class View {
    
    // контроллер - владелец вида
    private $controller;
    // массив переменных для view
    private $data = [];
    // массив метаданных для view
    private $meta = [];
    // шаблон html
    private $layout;
    
    public function __construct(Controller $controller, $layout = '') {
        $config = Application::getConfig();
        $this->controller = $controller;
        // шаблон html
        if ($layout ===  false)  {
            $this->layout = false;
        } else {
            $this->layout = $layout ? : Application::getConfig()->defaults->layout;
        }
        // мета
        $this->meta['title'] = $config->defaults->meta->title;
        $this->meta['decription'] = $config->defaults->meta->description;
        $this->meta['keywords'] = $config->defaults->meta->keywords;
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
    
    public function render() {
        $file = $this->getViewFilePath();
        if (is_file($file)) {
            // получить контент представления
            ob_start();
            require $file;
            $content = ob_get_clean();
            // получить контент шаблона html
            if (false !== $this->layout) {
                $file = $this->getLyaoutFilePath();
                //var_dump($this->getMetaHtml());
                if (is_file($file)) {
                    require $file;
                } else {
                    throw new \Exception("Не найден шаблон HTML: {$file}",500);
                }
            }
        } else {
            throw new \Exception("Не найдено представление: {$file}",500);
        }
    }
    
    /**
     * Возвращает путь к предсталениz в файловой системе
     * @return type
     */
    private function getViewFilePath() {
        $config = Application::getConfig();
        $adminPathPrefix = $this->controller->isAdmin() ? $config->dirs->admin : '';
        return  Utils::getRoot() . $config->dirs->views . '/' . $adminPathPrefix . '/' . 
                $this->controller->getControllerName() . '/' . 
                $this->controller->getActionName() . '.php';
    }
    
    /**
     * Возвращает путь к шаблону html в файловой системе
     * @return type
     */
    private function getLyaoutFilePath() {
        $config = Application::getConfig();
        return Utils::getRoot() . $config->dirs->layouts . '/' . $this->layout . '.php';
    }
    
    /**
     * Возвращает html-разметку метаданных
     * @return type
     */
    private function getMetaHtml() {
        return 
            "<title>{$this->meta['title']}</title>\n" .
            "<meta name=\"description\" content=\"{$this->meta['decription']}\">\n" . 
            "<meta name=\"keywords\" content=\"{$this->meta['keywords']}\">\n";
    }
}
