<?php

declare(strict_types=1);

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Contracts\RuleInterface;

class ImageRule implements RuleInterface
{
    public function validate(mixed $value, array $data): bool
    {
        if (empty($value)) return true;

        $tmpPath = $value['tmp_name'] ?? null;
        if (!$tmpPath || !file_exists($tmpPath)) return false;

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmpPath);

        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($mime, $allowedMimes, true);
    }

    public function getMessage(string $field): string
    {
        return "The field $field must be an image (jpg, png, gif, webp).";
    }
}
