<?php

declare(strict_types=1);

namespace App\Modules\Validation;

class ValidationResult
{
    private array $errors = [];

    public function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function firstError(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }
}
