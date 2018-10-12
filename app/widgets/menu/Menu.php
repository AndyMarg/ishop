<?php

namespace app\widgets\menu;

use core\base\Widget;

/**
 * Виджет меню
 */
class Menu extends Widget {
    
    // данные для построения иерархии меню
    private $data;
    // данные меню в виде дерева
    private $tree;
    // тэг контейнера
    protected $containerHtmlTag  = 'ul';
    
    public function __construct($data, $options = []) {
        $this->data = $data;
        $this->tree = $this->getTree();
        parent::__construct('menu', $options);
    }
    
    /**
     * Строим иерархический массив из плоского массива
     * @return type
     */
    private function getTree() {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }
    
    /**
     * Выводим html шаблон меню.
     * Переопределяет метод родителя
     */
    protected function outputTemplate() {
        // сформировать локальные переменные
        extract($this->getData());
        echo "\n<{$this->containerHtmlTag}>";
        $this->getChildsHtml($this->tree);
        echo "\n</{$this->containerHtmlTag}>\n";
    }
    
    /**
     * Выводим один уровень меню
     * @param type $tree
     * @param type $tab
     */
    protected function getChildsHtml($tree, $tab = '') {
        foreach ($tree as $id => $category) {
            require $this->getTpl();
        }
    }
    
}
