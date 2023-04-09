<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorName;
use PHPUnit\Framework\TestCase;

class AuthorNameTest extends TestCase
{
    public function test_generate_with_valid_string_value()
    {
        $nameValue = "alberto";

        $authorEmail = AuthorName::generate($nameValue);

        $this->assertEquals($nameValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_4_should_fail()
    {
        $nameValue = "abcd";

        $this->expectException(InvalidValueException::class);

        AuthorName::generate($nameValue);
    }

    public function test_generate_with_length_5_should_succeed()
    {
        $nameValue = "abcde";

        $authorEmail = AuthorName::generate($nameValue);

        $this->assertEquals($nameValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_50_should_succeed()
    {
        $nameValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN";

        $authorEmail = AuthorName::generate($nameValue);

        $this->assertEquals($nameValue, $authorEmail->getValue());
    }

    public function test_generate_with_length_51_should_fail()
    {
        $nameValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNO";

        $this->expectException(InvalidValueException::class);

        AuthorName::generate($nameValue);
    }
}
