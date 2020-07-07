<?php

use Components\Router;

try {
spl_autoload_register(function (string $className) { // автозагрузка классов
    require_once __DIR__ . '../../src/' . $className . '.php';   
});

$router = new Router();
$router->run();

} catch (\Exceptions\DbException $e) { // отлавливаем ошибку базы данных
    $view = new \View\View(__DIR__ . '/../templates/errors'); // создаем экземпляр обьекта view
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500); // вызываем метод render
    
} catch (\Exceptions\NotFoundException $e) { // отлавливаем ошибку наличия страницы
    $view = new \View\View(__DIR__ . '/../templates/errors');// создаем экземпляр обьекта view
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);// вызываем метод render
    
} catch (\Exceptions\UnauthorizedException $e) { // отлавливаем страницу авторизации
    $view = new \View\View(__DIR__ . '/../templates/errors');// создаем экземпляр обьекта view
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);// вызываем метод render
}
