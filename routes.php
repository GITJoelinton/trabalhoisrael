<?php

use FastRoute\RouteCollector;
use App\Controllers\UserController;

return FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', [UserController::class, 'loginForm']);
    $r->addRoute('GET', '/register', [UserController::class, 'registerForm']);
    $r->addRoute('POST', '/register/create', [UserController::class, 'create']);
    $r->addRoute('GET', '/login', [UserController::class, 'loginForm']);
    $r->addRoute('POST', '/login/auth', [UserController::class, 'authenticate']);
    $r->addRoute('GET', '/logout', [UserController::class, 'logout'] ?? function() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    });
    $r->addRoute('GET', '/dashboard', [UserController::class, 'dashboard'] ?? function() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        echo "<h1>Bem-vindo ao Dashboard</h1>";
        echo '<p><a href="/logout">Sair</a></p>';
    });
});
