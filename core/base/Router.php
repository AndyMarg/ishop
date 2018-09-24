<?php

namespace core\base;

/**
 * Маршрутизатор. Singleton
 */
class Router {
    
    use \core\libs\TSingleton;
    
    /**
     * Таблица маршрутизации
     * @var type array Регулярка соответствия uri => [controller, action]
     */
    private $routes = [];
    /**
     * Информация о маршруте
     * @var type array controller. action 
     */
    private $route = [];
    
    public function getRoutes(): array { return $this->routes; }
    public function getRoute(): array { return $this->route; }

    /**
     * Добавляет (изменяет) маршрут в таблице маршрутизации
     * @param string $regexp Регулярка соответствия uri 
     * @param type $route [controller, action]
     */
    public function add(string $regexp, $route = []) {
        $this->routes[$regexp] = $route;
    }
    
    /**
     * Инициализируем маршруты приложения и админки
     */
    public function Init() {
        // пути к свойствам маршрутов по умолчанию
        $path_base = Application::getConfig()->routes->default->base;
        $path_dyn = Application::getConfig()->routes->default->dynamic;

        // добавить маршруты админки 
        // (перед маршрутами приложения по умолчанию, так как регулярка более специфичная)
        $admin_uri = Application::getConfig()->admin->uri;
        $this->add(substr_replace($path_base->regexp, $admin_uri , 1, 0), ["controller" => $path_base->controller, "action" => $path_base->action]);
        $this->add(substr_replace($path_dyn->regexp, $admin_uri . '/', 1, 0));
        // добавить маршруты приложения
        $this->add($path_base->regexp, ["controller" => $path_base->controller, "action" => $path_base->action]);
        $this->add($path_dyn->regexp);
    }
    
    
    public function dispatch($uri) {
        if ($this->matchRoute($uri)) {
            echo 'Match found !!!!';
        } else {
            echo 'Match not found (((';
        }
    }
    
    /**
     * Формируем маршрут [controller, action] на основе совпадения uri с шаблоном регулярки
     * @param type $uri
     * @return boolean true, если совпадение в таблице маршрутов найдено
     */
    private function matchRoute($uri) {
        foreach ($this->routes as $pattern => $route) {
            $matches = [];
            if (preg_match("#{$pattern}#", $uri, $matches)) {
                // цикл ниже сработает только для uri типа "/controller/action" (или только "/controller")
                foreach ($matches as $key => $value) {
                     if (is_string($key)) {
                         $route[$key] = $value;
                     }
                }
                // цикл ниже сработает только для uri типа "/controller"
                if (!array_key_exists('action', $route)) {
                    $route['action'] = Application::getConfig()->routes->default->dynamic->action;
                }
                $this->route = $route;
                return true;
            }
        }
        return false;
    }
}
