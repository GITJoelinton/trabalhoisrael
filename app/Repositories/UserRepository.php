<?php
namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserRepository {
    
    public function findByUsername(string $username): ?array {
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(User $user): int {
    
        $stmt = Database::getConnection()->prepare("INSERT INTO users (username, senha) VALUES (?, ?)");
        $stmt->execute([$user->username, $user->senha]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(User $user): bool {
        $stmt = Database::getConnection()->prepare("UPDATE users SET username = ?, senha = ? WHERE id = ?");
        return $stmt->execute([$user->username, $user->senha, $user->id]);
    }

    public function delete(int $id): bool {
        $stmt = Database::getConnection()->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}