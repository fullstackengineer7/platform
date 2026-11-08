<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database\Database;
use App\Modules\Category\Domain\Category;
use App\Modules\Category\Domain\CategoryId;
use App\Modules\Category\Domain\CategoryName;
use App\Modules\Category\Domain\CategorySlug;
use App\Modules\Category\Infrastructure\MySqlCategoryRepository;
use App\Modules\Article\Domain\Article;
use App\Modules\Article\Domain\ArticleId;
use App\Modules\Article\Domain\ArticleTitle;
use App\Modules\Article\Domain\ArticleSlug;
use App\Modules\Article\Domain\ArticleStatus;
use App\Modules\Article\Infrastructure\MySqlArticleRepository;

$dbConfig = [
    'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8mb4',
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
];

$database = new Database($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
$pdo = $database->getConnection();

echo "Cleaning database...\n";
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE article_category");
$pdo->exec("TRUNCATE TABLE articles");
$pdo->exec("TRUNCATE TABLE categories");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

$categoryRepo = new MySqlCategoryRepository($database);
$articleRepo = new MySqlArticleRepository($database);

echo "Seeding categories...\n";
$categoriesData = [
    ['PHP', 'php', 'Everything about PHP 8.1+'],
    ['Architecture', 'architecture', 'DDD, SOLID and Clean Code'],
    ['Docker', 'docker', 'Containerization and DevOps'],
    ['MySQL', 'mysql', 'Database optimization and design'],
    ['Smarty', 'smarty', 'Templating engine guides'],
];

$createdCategories = [];
foreach ($categoriesData as $data) {
    $category = new Category(
        new CategoryId(0),
        new CategoryName($data[0]),
        new CategorySlug($data[1]),
        $data[2]
    );
    $categoryRepo->save($category);

    // Get the last inserted ID since our basic repo doesn't return it
    $id = (int)$pdo->lastInsertId();
    $createdCategories[] = new CategoryId($id);
}

echo "Seeding articles...\n";
$titles = [
    "Mastering PHP 8.1", "Clean Architecture in PHP", "Docker for Beginners",
    "MySQL Indexing Guide", "Smarty Templates Best Practices", "Understanding SOLID",
    "Domain Driven Design Basics", "Modular Monolith vs Microservices", "PHP-FPM Optimization",
    "The Power of Value Objects"
];

for ($i = 1; $i <= 30; $i++) {
    $title = $titles[array_rand($titles)] . " Part $i";
    $slugValue = strtolower($title);
    $slugValue = preg_replace('/[^a-z0-9]+/', '-', $slugValue);
    $slugValue = trim($slugValue, '-');
    $slug = $slugValue . '-' . $i;

    $article = new Article(
        new ArticleId(0),
        new ArticleTitle($title),
        new ArticleSlug($slug),
        "Description for article $i",
        "Full content for article $i. This is a test article to fill the database with realistic data.",
        null,
        rand(0, 1000),
        ArticleStatus::PUBLISHED
    );

    $articleRepo->save($article);
    $articleId = (int)$pdo->lastInsertId();

    // Assign to 1-3 random categories
    $randomCats = (array)array_rand($createdCategories, rand(1, 3));
    foreach ($randomCats as $catIdx) {
        $catId = $createdCategories[$catIdx]->value;
        $pdo->prepare("INSERT INTO article_category (article_id, category_id) VALUES (?, ?)")
            ->execute([$articleId, $catId]);
    }
}

echo "Seeding completed successfully!\n";
