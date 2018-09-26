<?php

namespace core\base;

use core\libs\TSingleton;

/**
 * Менеджер БД
 */
class db {
    
    use TSingleton;
    
    public function Init() {
        $config = Application::getConfig();
    }
}
