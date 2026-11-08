<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain;

use DateTimeImmutable;

class Category
{
    public function __construct(
        public readonly CategoryId $id,
        private CategoryName $name,
        private CategorySlug $slug,
        private string $description,
        private DateTimeImmutable $createdAt = new DateTimeImmutable(),
        private DateTimeImmutable $updatedAt = new DateTimeImmutable()
    ) {}

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }

    public function getSlug(): CategorySlug
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function updateDetails(CategoryName $name, CategorySlug $slug, string $description): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
