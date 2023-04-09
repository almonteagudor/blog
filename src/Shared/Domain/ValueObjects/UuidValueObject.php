<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Domain\Exceptions\InvalidUuidValueException;

class UuidValueObject
{
    private UuidInterface $value;

    /**
     * @throws InvalidUuidValueException
     */
    public static function generateFromString(string $value): static
    {
        if (!Uuid::isValid($value)) {
            throw new InvalidUuidValueException();
        }

        return new static(Uuid::fromString($value));
    }

    public static function generateRandom(): static
    {
        return new static(Uuid::uuid4());
    }

    public function getValue(): string
    {
        return $this->value->toString();
    }

    public function equals(UuidValueObject $uuidValueObject): bool
    {
        return $this->value->equals($uuidValueObject->value);
    }

    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }
}
