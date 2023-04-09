<?php

declare(strict_types=1);

namespace Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Shared\Domain\Exceptions\InvalidUuidValueException;
use Shared\Domain\ValueObjects\UuidValueObject;

class AuthorId
{
    private UuidValueObject $uuidValueObject;

    /**
     * @throws InvalidValueException
     */
    public static function generate(string $value): static
    {
        try {
            return new static(UuidValueObject::generateFromString($value));
        } catch (InvalidUuidValueException) {
            throw new InvalidValueException("Invalid AuthorId, should be a valid v4 uuid");
        }
    }

    public static function generateRandom(): static
    {
        return new static(UuidValueObject::generateRandom());
    }

    public function getValue(): string
    {
        return $this->uuidValueObject->getValue();
    }

    public function equals(AuthorId $authorId): bool
    {
        return $this->uuidValueObject->equals($authorId->uuidValueObject);
    }

    private function __construct(UuidValueObject $value)
    {
        $this->uuidValueObject = $value;
    }
}
