<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class MinLengthRule implements RuleInterface
{
    private int $min;

    public function __construct(string $param)
    {
        $this->min = (int)$param;
    }

    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;
        return \strlen((string)$value) >= $this->min;
    }

    public function getMessage(string $field): string
    {
        return "The field $field must be at least {$this->min} characters.";
    }
}
