<?php

declare(strict_types=1);

namespace Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use DateTime;

class AuthorBirthday
{
    private const FORMAT = "d/m/Y";
    private DateTime $value;

    /**
     * @throws InvalidValueException
     */
    public static function generate(string $value): static
    {
        $dateTimeValue = DateTime::createFromFormat(self::FORMAT, $value);

        if(!$dateTimeValue) {
            throw new InvalidValueException("Invalid AuthorBirthday, format should be dd/mm/yyyy");
        }

        return new static($dateTimeValue);
    }

    public static function generateFromNow(): static
    {
        return new static(new DateTime());
    }

    public function getValue(): string
    {
        return $this->value->format(self::FORMAT);
    }

    public function equals(AuthorBirthday $authorBirthday): bool
    {
        return $this->getValue() == $authorBirthday->getValue();
    }

    private function __construct(DateTime $value)
    {
        $this->value = $value;
    }
}
