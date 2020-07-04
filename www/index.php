<?php

try {
spl_autoload_register(function (string $className) { // автозагрузка классов
    require_once __DIR__ . '../../src/' . $className . '.php';   
});

ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly',1);
session_name('tsu');
session_start();

$route = $_GET['route'] ?? ''; // запрос или пустая строка

$routes = require __DIR__ . '/../src/routes.php'; // подключаем файл с роутами

$isRouteFound = false; // маршрут найден? - нет

foreach ($routes as $pattern => $controllerAndAction) { // в цикле проходим по заданным роутам
    preg_match($pattern, $route, $matches); // смотрим соответствует ли шаблон из роутов запросу
    if (!empty($matches)) { // если массив не пуст, что означает совпадение
        $isRouteFound = true; // то маршрут найден, возвращаем true
        break; // завершаем цикл, выходим
    }
}

if (!$isRouteFound) { // если маршрут не найден, бросаем исключение
    throw new \Exceptions\NotFoundException();
}

unset($matches[0]); // удаляем первое совпадение из массива

$controllerName = $controllerAndAction[0]; // получаем название контроллера
$actionName = $controllerAndAction[1]; // получаем название экшена

$controller = new $controllerName(); // создаем экземпляр класса контроллера
$controller->$actionName(...$matches); // вызываем его метод экшн и передаем массив значений, если есть

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
