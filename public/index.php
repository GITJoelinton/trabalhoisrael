<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../App/Core/csrf.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FastRoute\Dispatcher;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$routes = require dirname(__DIR__) . '/routes.php';

\App\Core\Csrf::ensureSession();

$request = Request::createFromGlobals();
$routeInfo = $routes->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response = new Response('404 Not Found', 404);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        $response = new Response('405 Method Not Allowed', 405, ['Allow' => implode(', ', $allowedMethods)]);
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controllerName = $handler[0];
        $methodName = $handler[1];

        if (!class_exists($controllerName)) {
            $response = new Response("Error: Controller class {$controllerName} not found.", 500);
            break;
        }

        $controller = new $controllerName();

        try {
            $response = call_user_func_array([$controller, $methodName], array_merge([$request], $vars));
        } catch (\Throwable $e) {
            $response = new Response("Erro no controlador: " . $e->getMessage(), 500);
        }
        break;
}

$response->send();
