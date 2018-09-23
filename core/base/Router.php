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

        // добавить маршруты приложения
        $this->add($path_base->regexp, [$path_base->controller, $path_base->action]);
        $this->add($path_dyn->regexp);
        // добавить маршруты админки
        $admin_uri = Application::getConfig()->admin->uri;
        $this->add(substr_replace($path_base->regexp, $admin_uri , 1, 0), [$path_base->controller, $path_base->action]);
        $this->add(substr_replace($path_dyn->regexp, $admin_uri . '/', 1, 0));
    }
    
    public function dispatch($uri) {
        $this->matchRoute($uri);
    }
    
    private function matchRoute($uri) {
       
    }
}
