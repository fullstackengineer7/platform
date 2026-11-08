<?php

declare(strict_types=1);

namespace App\Modules\Article\Infrastructure;

use App\Core\Database\Database;
use App\Modules\Article\Domain\Article;
use App\Modules\Article\Domain\ArticleId;
use App\Modules\Article\Domain\ArticleSlug;
use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Article\Domain\ArticleStatus;
use App\Modules\Category\Domain\CategoryId;
use PDO;
use DateTimeImmutable;

class MySqlArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(
        private Database $db
    ) {}

    public function findById(ArticleId $id): ?Article
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id->value]);
        $row = $stmt->fetch();

        return $row ? $this->mapToEntity($row) : null;
    }

    public function findBySlug(ArticleSlug $slug): ?Article
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM articles WHERE slug = ?");
        $stmt->execute([$slug->value]);
        $row = $stmt->fetch();

        return $row ? $this->mapToEntity($row) : null;
    }

    public function save(Article $article): void
    {
        $pdo = $this->db->getConnection();

        if ($article->getId() === null || $article->getId()->value === 0) {
            $stmt = $pdo->prepare("
                INSERT INTO articles (title, slug, description, content, image, views, status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $article->getTitle()->value,
                $article->getSlug()->value,
                $article->getDescription(),
                $article->getContent(),
                $article->getImagePath(),
                $article->getViews(),
                $article->getStatus()->value,
                $article->getCreatedAt()->format('Y-m-d H:i:s'),
                $article->getUpdatedAt()->format('Y-m-d H:i:s'),
            ]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE articles SET title = ?, slug = ?, description = ?, content = ?, image = ?, status = ?, updated_at = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $article->getTitle()->value,
                $article->getSlug()->value,
                $article->getDescription(),
                $article->getContent(),
                $article->getImagePath(),
                $article->getStatus()->value,
                $article->getUpdatedAt()->format('Y-m-d H:i:s'),
                $article->getId()->value,
            ]);
        }
    }

    public function delete(ArticleId $id): void
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id->value]);
    }

    public function getLatest(int $limit): array
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM articles WHERE status = 'published' ORDER BY created_at DESC, id DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $articles = [];
        while ($row = $stmt->fetch()) {
            $articles[] = $this->mapToEntity($row);
        }
        return $articles;
    }

    public function getByCategory(CategoryId $categoryId, int $offset, int $limit, string $sort = 'date'): array
    {
        $order = $sort === 'views' ? 'a.views DESC, a.created_at DESC' : 'a.created_at DESC, a.id DESC';
        $stmt = $this->db->getConnection()->prepare("
            SELECT a.* FROM articles a
            JOIN article_category ac ON a.id = ac.article_id
            WHERE ac.category_id = ? AND a.status = 'published'
            ORDER BY $order
            LIMIT ? OFFSET ?
        ");
        $stmt->bindValue(1, $categoryId->value, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, $offset, PDO::PARAM_INT);
        $stmt->execute();

        $articles = [];
        while ($row = $stmt->fetch()) {
            $articles[] = $this->mapToEntity($row);
        }
        return $articles;
    }

    public function getLatestForCategories(int $perCategory): array
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT t.category_id, t.id, t.title, t.slug, t.description, t.content, t.image, t.views, t.status, t.created_at, t.updated_at
            FROM (
                SELECT ac.category_id, a.*,
                    ROW_NUMBER() OVER (PARTITION BY ac.category_id ORDER BY a.created_at DESC, a.id DESC) AS rn
                FROM articles a
                JOIN article_category ac ON a.id = ac.article_id
                WHERE a.status = 'published'
            ) t
            WHERE t.rn <= ?
            ORDER BY t.category_id, t.rn
        ");
        $stmt->bindValue(1, $perCategory, PDO::PARAM_INT);
        $stmt->execute();

        $grouped = [];
        foreach ($stmt->fetchAll() as $row) {
            $grouped[(int)$row['category_id']][] = $this->mapToEntity($row);
        }
        return $grouped;
    }

    public function getRelated(Article $article, int $limit): array
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT a.* FROM articles a
            JOIN article_category ac1 ON a.id = ac1.article_id
            JOIN article_category ac2 ON ac1.category_id = ac2.category_id
            WHERE ac2.article_id = ? AND a.id != ? AND a.status = 'published'
            GROUP BY a.id
            ORDER BY a.views DESC
            LIMIT ?
        ");
        $stmt->bindValue(1, $article->getId()->value, PDO::PARAM_INT);
        $stmt->bindValue(2, $article->getId()->value, PDO::PARAM_INT);
        $stmt->bindValue(3, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $articles = [];
        while ($row = $stmt->fetch()) {
            $articles[] = $this->mapToEntity($row);
        }
        return $articles;
    }

    public function countByCategory(CategoryId $categoryId): int
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT COUNT(*) FROM articles a
            JOIN article_category ac ON a.id = ac.article_id
            WHERE ac.category_id = ? AND a.status = 'published'
        ");
        $stmt->execute([$categoryId->value]);
        return (int)$stmt->fetchColumn();
    }

    public function incrementViews(ArticleId $id): void
    {
        $stmt = $this->db->getConnection()->prepare("UPDATE articles SET views = views + 1 WHERE id = ?");
        $stmt->execute([$id->value]);
    }

    private function mapToEntity(array $row): Article
    {
        return new Article(
            new ArticleId((int)$row['id']),
            new \App\Modules\Article\Domain\ArticleTitle($row['title']),
            new \App\Modules\Article\Domain\ArticleSlug($row['slug']),
            $row['description'],
            $row['content'],
            $row['image'],
            (int)$row['views'],
            ArticleStatus::from($row['status']),
            new DateTimeImmutable($row['created_at']),
            new DateTimeImmutable($row['updated_at'])
        );
    }
}
