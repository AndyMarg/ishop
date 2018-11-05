<?php

namespace core\base;

/**
 * Класс модели с данными из БД
 */
abstract class _ModelDb extends _Model {
    
    private $options = [];  //  свойства модели
    
    /**
     * КОНСТРУКТОР
     * @param mix $data 
     *      Массив данных объекта модели, ид объекта модели или строка, 
     *      однозначно идентифицирующая объект модели для получения данных из БД
     * @param array $options Настройки модели (sql и т.д.)
     */
    public function __construct($data, array $options = null) {
        if (isset($options)) {
            $this->options = $options;
        }
        // если передан не массив данных, загружаем из БД    
        if (gettype($data) !== 'array') {
            $data = $this->load($data);
        }
        
        parent::__construct($data);
    }

    
    /**
     * Получить данные объекта модели из БД
     * @param mix $param 
     *      ид объекта модели или строка, однозначно идентифицирующая объект модели 
     *      для получения данных из БД
     * @return type Массив данных объекта модели из БД
     * @throws \Exception
     */
    private function load($param) {
        switch (gettype($param)):
            case 'integer':    // передан ид модели
                if (!key_exists('sql', $this->options) || empty($this->options['sql'])) {
                    throw new \Exception("Not defined SQL for model");
                }
                $sql = $this->options['sql'];
                $params = [];
                if (key_exists('params', $this->options) && !empty($this->options['params'])) {
                    $params = $this->options['params'];
                }
                break;
            case 'string':     // передана строка, однозначно идентифицирующая модель
                if (!key_exists('sql2', $this->options) || empty($this->options['sql2'])) {
                    throw new \Exception("Not defined SQL for model");
                }
                $sql = $this->options['sql2'];
                $params = [];
                if (key_exists('params2', $this->options) && !empty($this->options['params2'])) {
                    $params = $this->options['params2'];
                }
                break;
        endswitch;
        return Application::getDb()->query($sql, $params)[0];
    }
    
    /**
     * Сохраняем данные модели в БД
     */
    public function save() {
        
    }
    
}
