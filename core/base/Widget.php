<?php

namespace core\base;

use core\libs\Utils;

/**
 * Абстрактный класс виджета
 */
abstract class Widget {
   
    private $tpl;
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
        $this->tpl = Utils::getRoot() . Application::getConfig()->dirs->widgets . '/' . $name . '/tpl/' . $name . '.tpl.php';
        $this->run();
    }
    
    /**
     * Возвращает имя виджета
     * @return type
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Возвращает файл шаблона виджета
     * @return type
     */
    public function getTpl() {
        return $this->tpl;
    }
    
     /**
      * Виртуальный метод. Исполнение виджета
      */
    protected function  run() {
       echo $this->getHtml(); 
    }
    
    /**
     * Возвращаем html шаблон виджета
     * @return type
     */
    private function getHtml() {
        ob_start();
        require_once $this->getTpl();
        return ob_get_clean();
     }

}