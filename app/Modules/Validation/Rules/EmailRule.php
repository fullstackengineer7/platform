<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class EmailRule implements RuleInterface
{
    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getMessage(string $field): string
    {
        return "The field $field must be a valid email address.";
    }
}
