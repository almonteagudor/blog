<?php

declare(strict_types=1);

namespace Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;

class AuthorName
{
    private const MIN_LENGTH = 5;
    private const MAX_LENGTH = 50;

    private string $value;

    /**
     * @throws InvalidValueException
     */
    public static function generate(string $value): static
    {
        self::validate($value);

        return new static($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidValueException
     */
    private static function validate(string $value): void
    {
        if (strlen($value) < self::MIN_LENGTH || strlen($value) > self::MAX_LENGTH) {
            throw new InvalidValueException(sprintf("Invalid AuthorName, length should be between %s and %s", self::MAX_LENGTH, self::MAX_LENGTH));
        }
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
