<?php
namespace App\Models;
use App\Core\Database;
class User {
    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT id, username, name, email, profile_id, created_at, password FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function findByUsername(string $username) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function updatePassword(int $id, string $newHash) {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([$newHash, $id]);
    }

    public static function delete(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
