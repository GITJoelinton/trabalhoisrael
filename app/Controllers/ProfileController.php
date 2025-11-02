<?php
namespace App\Controllers;
use App\Models\User;
class ProfileController {
    private function requireAuth() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.php');
            exit;
        }
    }

    public function show() {
        $this->requireAuth();
        $user = User::find(intval($_SESSION['user_id']));
        include __DIR__ . '/../../app/Views/profile/show.php';
    }

    public function changePassword() {
        $this->requireAuth();
        $user = User::find(intval($_SESSION['user_id']));
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $error = '';
        if (!password_verify($current, $user['password'])) {
            $error = 'Senha atual incorreta.';
        } elseif (strlen($new) < 4) {
            $error = 'A nova senha precisa ter pelo menos 4 caracteres.';
        } elseif ($new !== $confirm) {
            $error = 'A nova senha e a confirmação não coincidem.';
        } else {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            User::updatePassword($user['id'], $hash);
            $success = 'Senha alterada com sucesso.';
            include __DIR__ . '/../../app/Views/profile/show.php';
            return;
        }
        include __DIR__ . '/../../app/Views/profile/show.php';
    }

    public function deleteAccount() {
        $this->requireAuth();
        $user = User::find(intval($_SESSION['user_id']));
        $inputUsername = trim($_POST['confirm_username'] ?? '');
        $inputPassword = $_POST['confirm_password'] ?? '';
        $error = '';
        if ($inputUsername !== $user['username']) {
            $error = 'Nome de usuário não corresponde.';
        } elseif (!password_verify($inputPassword, $user['password'])) {
            $error = 'Senha incorreta.';
        } else {
            User::delete($user['id']);
            session_start();
            session_unset();
            session_destroy();
            header('Location: /login.php?msg=conta_excluida');
            exit;
        }
        include __DIR__ . '/../../app/Views/profile/show.php';
    }
}
