<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\PostId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PostIdTest extends TestCase
{
    public function test_generateFromString_with_valid_string_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $postId = PostId::generate($uuid);

        $this->assertEquals($uuid, $postId->getValue());
    }

    public function test_generateFromString_with_invalid_string_value()
    {
        $uuid = "invalid uuid";

        $this->expectException(InvalidValueException::class);

        PostId::generate($uuid);
    }

    public function test_generateRandom_value_should_be_valid()
    {
        $postId = PostId::generateRandom();

        $this->assertTrue(Uuid::isValid($postId->getValue()));
    }

    public function test_equals_with_same_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $firstPostId = PostId::generate($uuid);
        $secondPostId = PostId::generate($uuid);

        $this->assertTrue($firstPostId->equals($secondPostId));
    }

    public function test_equals_with_different_value()
    {
        $firstUuid = "69afdc7c-d541-11ed-afa1-0242ac120002";
        $secondUuid = "bc65a7a8-d555-11ed-afa1-0242ac120002";

        $firstPostId = PostId::generate($firstUuid);
        $secondPostId = PostId::generate($secondUuid);

        $this->assertFalse($firstPostId->equals($secondPostId));
    }
}
