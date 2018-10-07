<?php

namespace app\widgets\menu;

use core\base\Widget;

/**
 * Виджет меню
 */
class Menu extends Widget {
    
    // данные для построения иерархии меню
    private $data;
    // тэг контейнера
    private $containerTag  = 'ul';
    
    public function __construct($data, $options = []) {
        $this->data = $data;
        parent::__construct('menu', $options);
    }
    
    protected function getTree() {
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
}
