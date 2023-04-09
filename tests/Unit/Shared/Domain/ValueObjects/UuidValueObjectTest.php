<?php

namespace Tests\Unit\Shared\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Exceptions\InvalidUuidValueException;
use Shared\Domain\ValueObjects\UuidValueObject;

class UuidValueObjectTest extends TestCase
{
    public function test_generateFromString_with_valid_string_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $uuidValueObject = UuidValueObject::generateFromString($uuid);

        $this->assertEquals($uuid, $uuidValueObject->getValue());
    }

    public function test_generateFromString_with_invalid_string_value()
    {
        $uuid = "invalid uuid";

        $this->expectException(InvalidUuidValueException::class);

        UuidValueObject::generateFromString($uuid);
    }

    public function test_generateRandom_value_should_be_valid()
    {
        $uuidValueObject = UuidValueObject::generateRandom();

        $this->assertTrue(Uuid::isValid($uuidValueObject->getValue()));
    }

    public function test_equals_with_same_value()
    {
        $uuid = "69afdc7c-d541-11ed-afa1-0242ac120002";

        $firstUuidValueObject = UuidValueObject::generateFromString($uuid);
        $secondUuidValueObject = UuidValueObject::generateFromString($uuid);

        $this->assertTrue($firstUuidValueObject->equals($secondUuidValueObject));
    }

    public function test_equals_with_different_value()
    {
        $firstUuid = "69afdc7c-d541-11ed-afa1-0242ac120002";
        $secondUuid = "bc65a7a8-d555-11ed-afa1-0242ac120002";

        $firstUuidValueObject = UuidValueObject::generateFromString($firstUuid);
        $secondUuidValueObject = UuidValueObject::generateFromString($secondUuid);

        $this->assertFalse($firstUuidValueObject->equals($secondUuidValueObject));
    }
}
