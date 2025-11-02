<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';
use App\Controllers\AuthController;
$auth = new AuthController();
$auth->logout();
