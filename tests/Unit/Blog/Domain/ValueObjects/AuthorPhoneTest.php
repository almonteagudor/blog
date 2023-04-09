<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorPhone;
use PHPUnit\Framework\TestCase;

class AuthorPhoneTest extends TestCase
{
    public function test_generate_with_valid_string_value()
    {
        $phoneValue = "654212121";

        $authorPhone = AuthorPhone::generate($phoneValue);

        $this->assertEquals($phoneValue, $authorPhone->getValue());
    }

    public function test_generate_with_length_8_should_fail()
    {
        $phoneValue = "65432323";

        $this->expectException(InvalidValueException::class);

        AuthorPhone::generate($phoneValue);
    }

    public function test_generate_with_length_10_should_fail()
    {
        $phoneValue = "6543232323";

        $this->expectException(InvalidValueException::class);

        AuthorPhone::generate($phoneValue);
    }
}
