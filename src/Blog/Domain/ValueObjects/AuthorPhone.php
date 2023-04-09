<?php

declare(strict_types=1);

namespace Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;

class AuthorPhone
{
    private const LENGTH = 9;

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
        if(strlen($value) != self::LENGTH) {
            throw new InvalidValueException(sprintf("Invalid AuthorPhone, length should be %s", self::LENGTH));
        }
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
