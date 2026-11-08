<?php

declare(strict_types=1);

namespace App\Modules\Media\Application;

use App\Modules\Media\Domain\StorageInterface;
use App\Modules\Validation\Contracts\ValidatorInterface;
use App\Modules\Validation\ValidationException;

class FileUploadService
{
    public function __construct(
        private StorageInterface $storage,
        private ValidatorInterface $validator
    ) {}

    public function upload(array $fileData, array $rules = []): string
    {
        if (empty($fileData['tmp_name'])) {
            throw new Exception("No file uploaded");
        }

        $this->validator->validate($fileData, $rules);

        return $this->storage->upload($fileData['tmp_name'], $fileData['name']);
    }

    public function delete(string $path): bool
    {
        return $this->storage->delete($path);
    }
}
