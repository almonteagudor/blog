<?php

namespace Tests\Unit\Blog\Domain\ValueObjects;

use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AuthorIdTest extends TestCase
{
    public function test_generateFromString_with_valid_string_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $authorId = AuthorId::generate($uuid);

        $this->assertEquals($uuid, $authorId->getValue());
    }

    public function test_generateFromString_with_invalid_string_value()
    {
        $uuid = "invalid uuid";

        $this->expectException(InvalidValueException::class);

        AuthorId::generate($uuid);
    }

    public function test_generateRandom_value_should_be_valid()
    {
        $authorId = AuthorId::generateRandom();

        $this->assertTrue(Uuid::isValid($authorId->getValue()));
    }

    public function test_equals_with_same_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $firstAuthorId = AuthorId::generate($uuid);
        $secondAuthorId = AuthorId::generate($uuid);

        $this->assertTrue($firstAuthorId->equals($secondAuthorId));
    }

    public function test_equals_with_different_value()
    {
        $firstUuid = "69afdc7c-d541-11ed-afa1-0242ac120002";
        $secondUuid = "bc65a7a8-d555-11ed-afa1-0242ac120002";

        $firstAuthorId = AuthorId::generate($firstUuid);
        $secondAuthorId = AuthorId::generate($secondUuid);

        $this->assertFalse($firstAuthorId->equals($secondAuthorId));
    }
}
