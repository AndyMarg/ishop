<?php

namespace core\base;

use core\libs\Attribute;
use core\libs\Utils;

/**
 * Абстрактный класс виджета
 */
abstract class Widget {
   
    private $name;
    private $tpl;
    private $js;
    private $attributes = [];
            
    // передаются через массив options
    private $table;
    private $containerTag = 'ul';
    private $cachePeriod = false;
        
    /**
     * Конструктор
     * @param string $name Имя виджета
     */
    public function __construct(string $name, $options = []) {
        $this->name = $name;
        $this->tpl = Utils::getRoot() . str_replace('{widget}', $name,  Application::getConfig()->dirs->widget_tpls) . '/'.  $name . '.tpl.php';
        $this->js =  Utils::getRoot() . str_replace('{widget}', $name,  Application::getConfig()->dirs->widget_scripts) . '/'.  $name . '.js';
        // устанавливаем атрибуты объекта
        foreach ($options as $key => $value) {
            if (key_exists($key, get_object_vars($this))) {
                $this->$key = $value;
            }
        }
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
     * Устанавливаем значение аттрибута
     * @param array $opts
     */
    protected function setAttribute(array $opts) {
        $this->attributes[$opts['name']] = new Attribute($opts);
    }

    /**
     * Возвращаем значение аттрибута
     * @param type $name
     * @return type
     */    
    protected function getAttribute($name) {
        return $this->attributes[$name];
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
        // сформировать локальные переменные (с именами аттрибутов) из массива атрибутов
        foreach ($this->attributes as $name => $ttribute) {
            $$name = $ttribute->getValue();
        }
        // получить контент из кэша
        $content = $this->htmlFromCache();
        // в кэше ничего нет - формируем снова
        if (!$content) {
            ob_start();
            // подключаем шаблон виджета
            require_once $this->tpl;
            //  подключаем скрипты виджета
            $file = $this->js;
            if (is_file($file)) { 
                echo "<script>\n";
                require_once $file;
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
         $content = Cache::load('widget_' . $this->name);
         return $content;
     }
     
     /**
      * Сохраняем разметку html в кэше
      * @param string $content
      */
     private function htmlToCache(string $content) {
         if ($this->cachePeriod) {
             Cache::save('widget_' . $this->name, $content, $this->cachePeriod);
         }
     }
     
}
