<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class NumericRule implements RuleInterface
{
    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;
        return is_numeric($value);
    }

    public function getMessage(string $field): string
    {
        return "The field $field must be numeric.";
    }
}
