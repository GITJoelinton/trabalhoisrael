<?php
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';
use App\Controllers\AuthController;
use App\Controllers\ProfileController;
// If not logged, redirect to login
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}
// show profile as dashboard (only logged user)
$profile = new ProfileController();
$profile->show();
