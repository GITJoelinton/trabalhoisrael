<?php
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';
use App\Controllers\ProfileController;
$controller = new ProfileController();
$action = $_GET['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'change_password') {
        $controller->changePassword();
    } elseif ($action === 'delete') {
        $controller->deleteAccount();
    } else {
        $controller->show();
    }
} else {
    $controller->show();
}
