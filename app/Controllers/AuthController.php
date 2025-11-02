<?php
namespace App\Controllers;
use App\Models\User;
class AuthController {
    public function showLogin($error = '') {
        include __DIR__ . '/../../app/Views/auth/login.php';
    }
    public function login() {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            header('Location: /');
            exit;
        } else {
            $error = 'Nome de usuário ou senha inválidos.';
            $this->showLogin($error);
        }
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login.php');
        exit;
    }
}
