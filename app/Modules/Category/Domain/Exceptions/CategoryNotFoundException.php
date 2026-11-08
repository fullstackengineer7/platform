<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain\Exceptions;

use Exception;

class CategoryNotFoundException extends Exception
{
    public function __construct(string $message = "Category not found")
    {
        parent::__construct($message, 404);
    }
}
