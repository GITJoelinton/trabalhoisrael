<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Core\Database;
require_once __DIR__ . '/../Core/csrf.php';

class UserController
{
    public function registerForm(Request $request, array $errors = [], array $old = [], string $success = ''): Response
    {
        return new Response($this->render('register', [
            'errors' => $errors,
            'old' => $old,
            'success' => $success
        ]));
    }

    public function create(Request $request): Response
    {
        $token = $request->request->get('_csrf');
        if (!\App\Core\Csrf::validate($token)) {
            return new Response('Token CSRF inválido.', 400);
        }

        $nome = trim($request->request->get('nome'));
        $email = trim($request->request->get('email'));
        $senha = trim($request->request->get('senha'));

        $errors = [];
        if (!$nome) $errors['nome'] = 'Nome obrigatório.';
        if (!$email) $errors['email'] = 'Email obrigatório.';
        if (!$senha) $errors['senha'] = 'Senha obrigatória.';

        if ($errors) {
            return $this->registerForm($request, $errors, ['nome' => $nome, 'email' => $email]);
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO users (nome,email,senha) VALUES (:nome,:email,:senha)");
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT)
        ]);

        return new RedirectResponse('/login?success=registered');
    }

    public function loginForm(Request $request, array $errors = [], array $old = [], string $success = ''): Response
    {
        return new Response($this->render('login', [
            'errors' => $errors,
            'old' => $old,
            'success' => $success
        ]));
    }

    public function authenticate(Request $request): Response
    {
        $token = $request->request->get('_csrf');
        if (!\App\Core\Csrf::validate($token)) {
            return new Response('Token CSRF inválido.', 400);
        }

        $email = trim($request->request->get('email'));
        $senha = trim($request->request->get('senha'));

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            return new RedirectResponse('/dashboard');
        }

        return $this->loginForm($request, ['login' => 'Email ou senha incorretos.'], ['email' => $email]);
    }

    public function logout(): RedirectResponse
    {
        session_start();
        session_destroy();
        return new RedirectResponse('/login');
    }

    public function dashboard(Request $request): Response
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            return new RedirectResponse('/login');
        }

        return new Response("<h1>Bem-vindo ao Dashboard</h1><p><a href='/logout'>Sair</a></p>");
    }

    private function render(string $template, array $data = []): string
    {
        $templates = new \League\Plates\Engine(__DIR__ . '/../Views');
        return $templates->render("auth/{$template}", $data);
    }
}
