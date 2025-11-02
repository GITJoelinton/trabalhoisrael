<?php
require_once __DIR__ . '/../app/Core/Database.php';
$db = App\Core\Database::getConnection();
$username = $argv[1] ?? 'admin';
$password = $argv[2] ?? '123456';
$name = $argv[3] ?? 'Administrador';
$email = $argv[4] ?? 'admin@example.com';
// ensure profiles table has admin
$stmt = $db->query("SELECT id FROM profiles WHERE name='admin' LIMIT 1");
$profile = $stmt->fetch();
if (!$profile) {
    $db->exec("INSERT INTO profiles (name) VALUES ('admin')");
    $profile_id = $db->lastInsertId();
} else {
    $profile_id = $profile['id'];
}
$stmt = $db->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo "Usuário $username já existe\n";
    exit;
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$insert = $db->prepare('INSERT INTO users (username, name, email, password, profile_id) VALUES (?, ?, ?, ?, ?)');
$insert->execute([$username, $name, $email, $hash, $profile_id]);
echo "Usuário $username criado com sucesso.\n";
