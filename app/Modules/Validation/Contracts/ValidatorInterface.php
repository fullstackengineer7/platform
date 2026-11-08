<?php

declare(strict_types=1);

namespace App\Modules\Validation\Contracts;

use App\Modules\Validation\ValidationResult;

interface ValidatorInterface
{
    public function validate(array $data, array $rules): ValidationResult;
}
