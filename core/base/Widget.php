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
    private $table;
    private $containerTag = 'ul';
    private $cachePeriod = false;
        
    /**
     * Конструктор
     * @param string $name Имя виджета
     * @param string $table Таблица с данными виджета. 
     */
    public function __construct(string $name, string $table = null) {
        $this->name = $name;
        if ($table) { $this->table = $table; }
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
     * Установить html тэг, который будет служить контейнером для html шаблона
     * @param string $containerTag
     */
    public function setContainerTag(string $containerTag) {
        $this->containerTag = $containerTag;
    }
    
    /**
     * Получить период кэширования html контента виджета
     * @return type
     */
    public function getCachePeriod() {
        return $this->cachePeriod;
    }

    /**
     * Установить период кэширования html контента виджета
     * @param type $cachePeriod
     */
    public function setCachePeriod($cachePeriod) {
        $this->cachePeriod = $cachePeriod;
    }
            
     /**
      * Виртуальный метод. Исполнение виджета
      */
    protected function  run() {
       echo $this->getHtml(); 
    }
    
    /**
     * Возвращаем html разметку виджета
     * @return type
     */
    private function getHtml() {
        $content = $this->htmlFromCache();
        // в кэше ничего нет - формируем снова
        if (!$content) {
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
            $content = ob_get_clean();
            $this->htmlToCache($content);
        }    
        return $content;
     }
     
     /**
      * Возвращает разметку html из кэша
      * @return mixed
      */
     private function htmlFromCache() {
         return false;
     }
     
     /**
      * Сохраняем разметку html в кэше
      * @param string $content
      */
     private function htmlToCache(string $content) {
         if (!$this->cachePeriod) return;
     }
}
