<?php

namespace core\base;

/**
 * Базовый клас контроллера
 */
abstract class Controller {
    
    // маршрут к контроллеру
    private $route;
    public function __construct($route) {
        $this->route = $route;
    }
    
    public function getRoute() { return $this->route;}
    public function getController() { return $this->route['controller']; }
    public function getView() { return $this->route['action']; }
    public function getModel() { return $this->route['action']; }
    
}
