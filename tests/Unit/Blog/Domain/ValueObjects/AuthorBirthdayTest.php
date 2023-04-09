<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorBirthday;
use DateTime;
use PHPUnit\Framework\TestCase;

class AuthorBirthdayTest extends TestCase
{
    private const FORMAT = "d/m/Y";

    public function test_generateFromString_with_valid_string_value()
    {
        $dateValue = "14/01/1990";

        $authorBirthday = AuthorBirthday::generate($dateValue);

        $this->assertEquals($dateValue, $authorBirthday->getValue());
    }

    public function test_generateFromString_with_invalid_string_value()
    {
        $dateValue = "14:01:1990";

        $this->expectException(InvalidValueException::class);

        AuthorBirthday::generate($dateValue);
    }

    public function test_generateFromNow_value_should_be_datetime_now()
    {
        $dateTimeNow = new DateTime();

        $authorBirthday = AuthorBirthday::generateFromNow();

        $this->assertEquals($dateTimeNow->format(self::FORMAT), $authorBirthday->getValue());
    }

    public function test_equals_with_same_value()
    {
        $dateValue = "14/01/1990";

        $firstAuthorBirthday = AuthorBirthday::generate($dateValue);
        $secondAuthorBirthday = AuthorBirthday::generate($dateValue);

        $this->assertTrue($firstAuthorBirthday->equals($secondAuthorBirthday));
    }

    public function test_equals_with_different_value()
    {
        $firstDateValue = "14/01/1990";
        $secondDateValue = "07/04/2023";

        $firstAuthorBirthday = AuthorBirthday::generate($firstDateValue);
        $secondAuthorBirthday = AuthorBirthday::generate($secondDateValue);

        $this->assertFalse($firstAuthorBirthday->equals($secondAuthorBirthday));
    }
}
