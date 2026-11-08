<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class MaxLengthRule implements RuleInterface
{
    private int $max;

    public function __construct(string $param)
    {
        $this->max = (int)$param;
    }

    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;
        return \strlen((string)$value) <= $this->max;
    }

    public function getMessage(string $field): string
    {
        return "The field $field may not be longer than {$this->max} characters.";
    }
}
