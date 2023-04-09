<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\PostTitle;
use PHPUnit\Framework\TestCase;

class PostTitleTest extends TestCase
{
    public function test_generate_with_valid_string_value()
    {
        $titleValue = "This is the title of the post";

        $postTitle = PostTitle::generate($titleValue);

        $this->assertEquals($titleValue, $postTitle->getValue());
    }

    public function test_generate_with_length_4_should_fail()
    {
        $titleValue = "0123";

        $this->expectException(InvalidValueException::class);

        PostTitle::generate($titleValue);
    }

    public function test_generate_with_length_5_should_succeed()
    {
        $titleValue = "01234";

        $postTitle = PostTitle::generate($titleValue);

        $this->assertEquals($titleValue, $postTitle->getValue());
    }

    public function test_generate_with_length_50_should_succeed()
    {
        $titleValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN";

        $postTitle = PostTitle::generate($titleValue);

        $this->assertEquals($titleValue, $postTitle->getValue());
    }

    public function test_generate_with_length_51_should_fail()
    {
        $titleValue = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN0";

        $this->expectException(InvalidValueException::class);

        PostTitle::generate($titleValue);
    }
}
