<?php

namespace Components;

class Router 
{
    /** @var array */
    private $routes;
    /** @var string */
    private $route;       

    public function __construct() 
    {
        $routesPath = __DIR__ . '/../../src/config/routes.php';
        $this->routes = require $routesPath;
        $this->route = '';
    }
   
    /**
     * @return void
     * @throws \Exceptions\NotFoundException
     */
    public function run(): void
    {
        $isRouteFound = false;  
        
        $this->route = $_GET['route']; // запрос
        
        foreach ($this->routes as $pattern => $controllerAndAction) {
            preg_match($pattern, $this->route, $matches); 
            if (!empty($matches)) {
                $isRouteFound = true;
                break; 
            }
        }

        if (!$isRouteFound) { 
            throw new \Exceptions\NotFoundException();
        }

        unset($matches[0]);

        $controllerName = $controllerAndAction[0]; 
        $actionName = $controllerAndAction[1]; 

        $controller = new $controllerName();
        $controller->$actionName(...$matches);
    }
}
