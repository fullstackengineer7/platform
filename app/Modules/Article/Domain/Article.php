<?php

declare(strict_types=1);

namespace App\Modules\Article\Domain;

use DateTimeImmutable;

class Article
{
    public function __construct(
        public readonly ArticleId $id,
        private ArticleTitle $title,
        private ArticleSlug $slug,
        private string $description,
        private string $content,
        private ?string $imagePath = null,
        private int $views = 0,
        private ArticleStatus $status = ArticleStatus::DRAFT,
        private DateTimeImmutable $createdAt = new DateTimeImmutable(),
        private DateTimeImmutable $updatedAt = new DateTimeImmutable()
    ) {}

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getTitle(): ArticleTitle
    {
        return $this->title;
    }

    public function getSlug(): ArticleSlug
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getStatus(): ArticleStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function updateDetails(ArticleTitle $title, ArticleSlug $slug, string $description, string $content, ?string $imagePath = null): void
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->description = $description;
        $this->content = $content;
        $this->imagePath = $imagePath;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function setStatus(ArticleStatus $status): void
    {
        $this->status = $status;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function incrementViews(): void
    {
        $this->views++;
    }
}
