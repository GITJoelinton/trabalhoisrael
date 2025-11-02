<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/Core/Database.php';

use App\Core\Database;

$db = (new Database())->getConnection();
$migrationsPath = __DIR__ . '/db/migrations/';
$migrationFiles = glob($migrationsPath . '*.php');

foreach ($migrationFiles as $file) {
    require_once $file;

    
    $baseName = pathinfo($file, PATHINFO_FILENAME);
    $parts = explode('_', $baseName, 2);
    $className = isset($parts[1]) ? str_replace('_', '', ucwords($parts[1], '_')) : $baseName;

    if (class_exists($className)) {
        $migration = new $className();
        $migration->up($db);
        echo "Migration executada: {$className}\n";
    } else {
        echo "Classe {$className} não encontrada em {$file}\n";
    }
}
