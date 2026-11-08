<?php

declare(strict_types=1);

namespace App\Modules\Validation\Contracts;

interface RuleInterface
{
    public function validate(mixed $value, array $data): bool;
    public function getMessage(string $field): string;
}
