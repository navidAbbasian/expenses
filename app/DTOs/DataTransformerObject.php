<?php

namespace App\DTOs;

abstract class DataTransformerObject
{
    /**
     * The name of the class on which the query is applied
     */
    protected string $modelClass;

    public function __construct() {}

    public function toArray(): array
    {
        $hasValueArray = [];

        foreach ($this as $key => $value) {
            if ($value) {
                $hasValueArray[$key] = $value;
            }
        }

        return $hasValueArray;
    }

    public function toModel(): mixed
    {
        return new (app($this->modelClass ?? self::guessModelClass()))($this->toArray());
    }

    /**
     * find class name from repository class
     */
    private static function guessModelClass(): string
    {
        return preg_replace('/(.+)\\\\DTOs\\\\(.+)DTO$/m', '$1\Models\\\$2', static::class);
    }
}
