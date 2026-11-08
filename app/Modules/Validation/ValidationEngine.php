<?php

declare(strict_types=1);

namespace App\Modules\Validation;

use App\Modules\Validation\Contracts\ValidatorInterface;
use App\Modules\Validation\Contracts\RuleInterface;
use App\Modules\Validation\Rules\RequiredRule;
use App\Modules\Validation\Rules\EmailRule;
use App\Modules\Validation\Rules\StringRule;
use App\Modules\Validation\Rules\NumericRule;
use App\Modules\Validation\Rules\MinLengthRule;
use App\Modules\Validation\Rules\MaxLengthRule;
use App\Modules\Validation\Rules\ImageRule;
use App\Modules\Validation\Rules\MaxFileSizeRule;
use Exception;

class ValidationEngine implements ValidatorInterface
{
    private array $ruleMap = [];

    public function __construct()
    {
        $this->ruleMap = [
            'required' => RequiredRule::class,
            'email' => EmailRule::class,
            'string' => StringRule::class,
            'numeric' => NumericRule::class,
            'min_length' => MinLengthRule::class,
            'max_length' => MaxLengthRule::class,
            'image' => ImageRule::class,
            'max_file_size' => MaxFileSizeRule::class,
        ];
    }

    public function validate(array $data, array $rules): ValidationResult
    {
        $result = new ValidationResult();

        foreach ($rules as $field => $fieldRules) {
            $fieldRules = (array)$fieldRules;

            foreach ($fieldRules as $ruleDefinition) {
                $rule = $this->resolveRule($ruleDefinition);

                $value = $data[$field] ?? null;

                if (!$rule->validate($value, $data)) {
                    $result->addError($field, $rule->getMessage($field));
                }
            }
        }

        return $result;
    }

    private function resolveRule(string $definition): RuleInterface
    {
        $parts = explode(':', $definition);
        $ruleName = $parts[0];
        $param = $parts[1] ?? null;

        if (!isset($this->ruleMap[$ruleName])) {
            throw new Exception("Unsupported validation rule: $ruleName");
        }

        $ruleClass = $this->ruleMap[$ruleName];

        if ($param !== null) {
            return new $ruleClass($param);
        }

        return new $ruleClass();
    }
}
