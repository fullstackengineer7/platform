<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(mixed $value, array $data): bool
    {
        return !empty($value) || isset($value) && $value !== '';
    }

    public function getMessage(string $field): string
    {
        return "The field $field is required.";
    }
}
