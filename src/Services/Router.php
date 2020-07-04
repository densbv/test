<?php

namespace Services;

use helpers\Helper;

class Router 
{
    /** @var array */
    private $routes;
    /** @var string */
    private $route;
    /** @var bool */        
    private $isRouteFound;

    public function __construct() 
    {
        // Подключаем файл с маршрутами routes.php
        $routesPath = __DIR__ . '/../../src/routes.php';
        $this->routes = require $routesPath;
        $this->route = ''; // пустая строка
        $this->isRouteFound = false; // маршрут найден? - нет
    }
   
    /**
     * @return void
     * @throws \Exceptions\NotFoundException
     */
    public function run(): void
    {
        $this->route = $_GET['route']; // запрос
        
        foreach ($this->routes as $pattern => $controllerAndAction) { // в цикле проходим по заданным роутам
            preg_match($pattern, $this->route, $matches); // смотрим соответствует ли шаблон из роутов запросу
            if (!empty($matches)) { // если массив не пуст, что означает совпадение
                $this->isRouteFound = true; // то маршрут найден, возвращаем true
                break; // завершаем цикл, выходим
            }
        }

        if (!$this->isRouteFound) { // если маршрут не найден, бросаем исключение
            throw new \Exceptions\NotFoundException();
        }

        unset($matches[0]); // удаляем первое совпадение из массива

        $controllerName = $controllerAndAction[0]; // получаем название контроллера
        $actionName = $controllerAndAction[1]; // получаем название экшена

        $controller = new $controllerName(); // создаем экземпляр класса контроллера
        $controller->$actionName(...$matches); // вызываем его метод экшн и передаем массив значений, если есть
    }
}
