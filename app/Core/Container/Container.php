<?php

declare(strict_types=1);

namespace App\Core\Container;

use Exception;
use ReflectionClass;
use ReflectionParameter;

class Container
{
    private array $instances = [];
    private array $definitions = [];

    public function set(string $id, mixed $concrete = null): void
    {
        $this->definitions[$id] = $concrete ?? $id;
    }

    public function singleton(string $id, mixed $concrete = null): void
    {
        $this->set($id, $concrete);
        $this->instances[$id] = null;
    }

    public function get(string $id): mixed
    {
        if (($this->instances[$id] ?? null) !== null) {
            return $this->instances[$id];
        }

        $concrete = $this->definitions[$id] ?? $id;
        $object = $this->resolve($concrete);

        if (array_key_exists($id, $this->instances)) {
            $this->instances[$id] = $object;
        }

        return $object;
    }

    private function resolve(mixed $concrete): mixed
    {
        if (is_callable($concrete)) {
            return $concrete($this);
        }

        if (!is_string($concrete) || !class_exists($concrete)) {
            throw new Exception("Cannot resolve class: " . (is_string($concrete) ? $concrete : gettype($concrete)));
        }

        return $this->build($concrete);
    }

    private function build(string $className): mixed
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new Exception("Class {$className} is not instantiable.");
        }

        $constructor = $reflectionClass->getConstructor();

        if (null === $constructor) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencies[] = $this->resolveParameter($parameter);
        }

        return $dependencies;
    }

    private function resolveParameter(ReflectionParameter $parameter): mixed
    {
        $type = $parameter->getType();

        if (!$type || $type->isBuiltin()) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }
            throw new Exception("Unable to resolve builtin parameter {$parameter->getName()}");
        }

        $typeName = $type->getName();
        return $this->get($typeName);
    }
}
