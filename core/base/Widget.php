<?php

namespace core\base;

use core\libs\Utils;

/**
 * Абстрактный класс виджета
 */
abstract class Widget {
   
    private $tpl;
    private $name;
    private $js;
        
    public function __construct($name) {
        $this->name = $name;
        $this->tpl = Utils::getRoot() . str_replace('{widget}', $name,  Application::getConfig()->dirs->widget_tpls) . '/'.  $name . '.tpl.php';
        $this->js =  Utils::getRoot() . str_replace('{widget}', $name,  Application::getConfig()->dirs->widget_scripts) . '/'.  $name . '.js';
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
     * Возвращает файл js виджета
     * @return type
     */
    public function getJs() {
        return $this->js;
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
        // подключаем шаблон виджета
        require_once $this->getTpl();
        //  подключаем скрипты виджета
        $file = $this->getJs();
        if (is_file($file)) { 
            echo "<script>\n";
            require_once $this->getJs();
            echo "</script>\n";
        }    
        return ob_get_clean();
     }
}
