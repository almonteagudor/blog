<?php

namespace Tests\Unit\Blog\Domain;

use Blog\Domain\Author;
use Blog\Domain\ValueObjects\AuthorBirthday;
use Blog\Domain\ValueObjects\AuthorEmail;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\AuthorName;
use Blog\Domain\ValueObjects\AuthorPhone;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    private Author $author;

    private string $id = "69afdc7c-d541-11ed-afa1-0242ac120002";
    private string $name = "Alberto";
    private string $email = "alberto@mail.com";
    private string $phone = "654321987";
    private string $birthday = "14/01/1990";

    protected function setUp(): void
    {
        $this->author = new Author(
            AuthorId::generate($this->id),
            AuthorName::generate($this->name),
            AuthorEmail::generate($this->email),
            AuthorPhone::generate($this->phone),
            AuthorBirthday::generate($this->birthday)
        );

        parent::setUp();
    }

    public function test_getId()
    {
        self::assertEquals($this->id, $this->author->getId()->getValue());
    }

    public function test_getName()
    {
        self::assertEquals($this->name, $this->author->getName()->getValue());
    }


    public function test_getEmail()
    {
        self::assertEquals($this->email, $this->author->getEmail()->getValue());
    }

    public function test_getPhone()
    {
        self::assertEquals($this->phone, $this->author->getPhone()->getValue());
    }

    public function test_getBirthday()
    {
        self::assertEquals($this->birthday, $this->author->getBirthday()->getValue());
    }
}
