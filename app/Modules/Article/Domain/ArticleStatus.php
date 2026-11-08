<?php

declare(strict_types=1);

namespace App\Modules\Article\Domain;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
