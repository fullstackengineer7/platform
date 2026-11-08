<?php

declare(strict_types=1);

namespace App\Modules\Category\Infrastructure;

use App\Core\Database\Database;
use App\Modules\Category\Domain\Category;
use App\Modules\Category\Domain\CategoryId;
use App\Modules\Category\Domain\CategorySlug;
use App\Modules\Category\Domain\CategoryRepositoryInterface;
use App\Modules\Category\Domain\CategoryName;
use PDO;
use DateTimeImmutable;

class MySqlCategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private Database $db
    ) {}

    public function findById(CategoryId $id): ?Category
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id->value]);
        $row = $stmt->fetch();

        return $row ? $this->mapToEntity($row) : null;
    }

    public function findBySlug(CategorySlug $slug): ?Category
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM categories WHERE slug = ?");
        $stmt->execute([$slug->value]);
        $row = $stmt->fetch();

        return $row ? $this->mapToEntity($row) : null;
    }

    public function save(Category $category): void
    {
        $pdo = $this->db->getConnection();

        if ($category->getId()->value === 0) {
            $stmt = $pdo->prepare("
                INSERT INTO categories (name, slug, description, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $category->getName()->value,
                $category->getSlug()->value,
                $category->getDescription(),
                $category->getCreatedAt()->format('Y-m-d H:i:s'),
                $category->getUpdatedAt()->format('Y-m-d H:i:s'),
            ]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE categories SET name = ?, slug = ?, description = ?, updated_at = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $category->getName()->value,
                $category->getSlug()->value,
                $category->getDescription(),
                $category->getUpdatedAt()->format('Y-m-d H:i:s'),
                $category->getId()->value,
            ]);
        }
    }

    public function delete(CategoryId $id): void
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id->value]);
    }

    public function findAll(): array
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM categories ORDER BY name ASC");
        $stmt->execute();

        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = $this->mapToEntity($row);
        }
        return $categories;
    }

    private function mapToEntity(array $row): Category
    {
        return new Category(
            new CategoryId((int)$row['id']),
            new CategoryName($row['name']),
            new CategorySlug($row['slug']),
            $row['description'],
            new DateTimeImmutable($row['created_at']),
            new DateTimeImmutable($row['updated_at'])
        );
    }
}
