<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\PostBody;
use PHPUnit\Framework\TestCase;

class PostBodyTest extends TestCase
{
    public function test_generate_with_valid_string_value()
    {
        $bodyValue = "This is the body of the post";

        $postBody = PostBody::generate($bodyValue);

        $this->assertEquals($bodyValue, $postBody->getValue());
    }


    public function test_generate_with_length_0_should_succeed()
    {
        $bodyValue = "";

        $postBody = PostBody::generate($bodyValue);

        $this->assertEquals($bodyValue, $postBody->getValue());
    }

    public function test_generate_with_length_500_should_succeed()
    {
        $bodyValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN";

        $postBody = PostBody::generate($bodyValue);

        $this->assertEquals($bodyValue, $postBody->getValue());
    }

    public function test_generate_with_length_501_should_fail()
    {
        $bodyValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0";

        $this->expectException(InvalidValueException::class);

        PostBody::generate($bodyValue);
    }
}
