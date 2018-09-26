<?php

namespace core\base;

/**
 * Абстрактный класс модели
 */
class Model {
    
    // поля данных (вероятно из базы)
    private $attributes = [];
    // ошибки
    private $errors = [];
    // ошибки валидации
    private $rules = [];
    
    public function __construct() {
        
    }
}
