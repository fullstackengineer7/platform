<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class MaxFileSizeRule implements RuleInterface
{
    private int $maxSize;

    public function __construct(string $param)
    {
        $this->maxSize = (int)$param;
    }

    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;

        $size = $value['size'] ?? 0;
        return $size <= $this->maxSize;
    }

    public function getMessage(string $field): string
    {
        $mb = round($this->maxSize / 1024 / 1024, 2);
        return "The field $field may not be larger than {$mb} MB.";
    }
}
