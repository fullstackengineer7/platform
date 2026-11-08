<?php

declare(strict_types=1);

namespace App\Modules\Validation;

use Exception;

class ValidationException extends Exception
{
    public function __construct(
        public readonly ValidationResult $result
    ) {
        parent::__construct("Validation failed");
    }

    public function getValidationResult(): ValidationResult
    {
        return $this->result;
    }
}
