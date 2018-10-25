<?php

namespace core\base;

use core\libs\TSingleton;
use core\libs\Utils;

require_once Utils::getRoot() . '/vendor/rb-mysql.php';

/**
 * Менеджер БД
 */
class db {
    private $db;
    
    use TSingleton;
    
    public function Init() {
        $config = Application::getConfig();
        // подключаемся
        \R::setup($config->db->dsn, $config->db->user, $config->db->pass);
        // проверяем соединение
        if (!\R::testConnection()) {
            throw new \Exception('Ошибка соединения с БД', 500);
        }
        // запрещаем автоматическое изменение структуры
        \R::freeze(true);
        // включаем возможность отладки запросов
        if (Application::getConfig()->mode === "development" && $config->db->debug) {
            \R::debug(true, 1 ); //select MODE 2 to see parameters filled in
            //\R::fancyDebug();   //since 4.2
        }
        
        $this->addInit();
    }
    
    private function addInit() {
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $config = Application::getConfig();
        $this->db = new \PDO($config->db->dsn, $config->db->user, $config->db->pass, $opt);
    }
    
    public function query(string $sql, array $params) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }          
    
}
