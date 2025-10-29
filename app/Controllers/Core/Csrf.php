<?php
namespace App\Core;

class Csrf
{
    public static function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }
    }

    public static function input(): string
    {
        self::ensureSession();
        $token = $_SESSION['_csrf'];
        return '<input type="hidden" name="_csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function validate(?string $token): bool
    {
        self::ensureSession();
        if (!isset($_SESSION['_csrf'])) return false;
        return hash_equals($_SESSION['_csrf'], $token ?? '');
    }
}
