<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database\Database;

$dbConfig = [
    'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8mb4',
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
];

$database = new Database($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
$pdo = $database->getConnection();

$sql = file_get_contents(__DIR__ . '/../database/migrations/001_initial_schema.sql');

try {
    $pdo->exec($sql);
    echo "Migrations executed successfully!\n";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
