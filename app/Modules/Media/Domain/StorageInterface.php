<?php

declare(strict_types=1);

namespace App\Modules\Media\Domain;

interface StorageInterface
{
    public function upload(string $sourcePath, string $filename): string;
    public function delete(string $path): bool;
    public function exists(string $path): bool;
    public function getUrl(string $path): string;
}
