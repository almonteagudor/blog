<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorEmail;
use PHPUnit\Framework\TestCase;

class AuthorEmailTest extends TestCase
{
    public function test_generate_with_valid_string_value()
    {
        $emailValue = "alberto@mail.com";

        $authorEmail = AuthorEmail::generate($emailValue);

        $this->assertEquals($emailValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_4_should_fail()
    {
        $emailValue = "abcd";

        $this->expectException(InvalidValueException::class);

        AuthorEmail::generate($emailValue);
    }

    public function test_generate_with_length_5_should_succeed()
    {
        $emailValue = "abcde";

        $authorEmail = AuthorEmail::generate($emailValue);

        $this->assertEquals($emailValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_100_should_succeed()
    {
        $emailValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.0123456789abcdefghijklmnopqrstuvwxyzA";

        $authorEmail = AuthorEmail::generate($emailValue);

        $this->assertEquals($emailValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_101_should_fail()
    {
        $emailValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.0123456789abcdefghijklmnopqrstuvwxyzAB";

        $this->expectException(InvalidValueException::class);

        AuthorEmail::generate($emailValue);
    }
}
