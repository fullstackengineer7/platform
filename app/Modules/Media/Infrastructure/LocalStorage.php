<?php

declare(strict_types=1);

namespace App\Modules\Media\Infrastructure;

use App\Modules\Media\Domain\StorageInterface;
use Exception;

class LocalStorage implements StorageInterface
{
    private string $storagePath;
    private string $publicUrl;

    public function __construct(string $storagePath, string $publicUrl)
    {
        $this->storagePath = rtrim($storagePath, '/');
        $this->publicUrl = rtrim($publicUrl, '/');
    }

    public function upload(string $sourcePath, string $filename): string
    {
        if (!file_exists($sourcePath)) {
            throw new Exception("Source file not found");
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $uniqueName = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = $this->storagePath . '/' . $uniqueName;

        if (!move_uploaded_file($sourcePath, $destination)) {
            if (!copy($sourcePath, $destination)) {
                throw new Exception("Failed to move uploaded file");
            }
        }

        return $uniqueName;
    }

    public function delete(string $path): bool
    {
        $fullPath = $this->storagePath . '/' . $path;

        if (str_contains($path, '..') || str_contains($path, '/')) {
            return false;
        }

        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    public function exists(string $path): bool
    {
        return file_exists($this->storagePath . '/' . $path);
    }

    public function getUrl(string $path): string
    {
        return $this->publicUrl . '/' . $path;
    }
}
