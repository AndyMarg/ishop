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
    private $containerTag  = 'ul';
    
    public function __construct($data, $options = []) {
        $this->data = $data;
        $this->tree = $this->getTree();
        parent::__construct('menu', $options);
    }
    
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
    
    protected function outputTemplate() {
        // сформировать локальные переменные
        extract($this->getData());
    }
    
    protected function getMenuHtml() {
        $str = '';
        
    }
}
