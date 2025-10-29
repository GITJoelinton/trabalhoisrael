<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService {
    private UserRepository $repo;

    public function __construct() {
        $this->repo = new UserRepository();
    }

    public function createUser(string $username, string $password): ?int {
        if ($this->repo->findByUsername($username)) {
            return null; 
        }

        $hashedSenha = password_hash($password, PASSWORD_BCRYPT);
        
        $user = new User(null, $username, $hashedSenha);
        
        return $this->repo->create($user);
    }

    public function authenticate(string $username, string $password): ?array {
        $user = $this->repo->findByUsername($username);
        
        if ($user && password_verify($password, $user['senha'])) {
            return $user;
        }
        return null;
    }

    public function validate(string $username, string $password): array {
        $errors = [];
        if (trim($username) === '') $errors['username'] = 'Nome de usuário é obrigatório.';
        if (strlen($password) < 6) $errors['senha'] = 'A senha deve ter pelo menos 6 caracteres.';
        return $errors;
    }
    
    public function updateProfile(int $id, string $username, string $password): bool {
        $user = $this->repo->findById($id);
        if (!$user) return false;

        $existingUser = $this->repo->findByUsername($username);
        if ($existingUser && (int)$existingUser['id'] !== $id) {
            return false;
        }

        $hashedSenha = password_hash($password, PASSWORD_BCRYPT);
        
        $updatedUser = new User($id, $username, $hashedSenha, $user['created_at']);
        
        return $this->repo->update($updatedUser);
    }

    public function deleteUser(int $id): bool {
        return $this->repo->delete($id);
    }
}