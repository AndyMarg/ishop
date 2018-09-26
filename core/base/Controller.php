<?php

namespace core\base;

/**
 * Базовый клас контроллера
 */
abstract class Controller {
    
    // маршрут к контроллеру
    private $route;
    // текущее представление
    private $view = null;
    
    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($this);
    }
    
    public function getView() { return $this->view; }
    public function getRoute() { return $this->route; }
    public function getControllerName() { return $this->route['controller']; }
    public function getActionName() { return $this->route['action']; }
    public function isAdmin() { return isset($this->route['admin']); }
    
    /**
     * Подготавливаем данные и вызываем нужное представление
     * @throws \Exception
     */
    public function dispatch() {
        $this->callAction();
        $this->view->render();
    }
    
    /**
     * Вызываем метод действия в соответствии с маршрутом для подготовки данных для представления
     * @throws \Exception
     */
    private function callAction() {
        $action = $this->route['action'] . 'Action';
        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            throw new \Exception("Метод не найден: {$this->class}::{$action}", 500);
        }
    }
    
}
