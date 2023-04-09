<?php

namespace Blog\Domain;

use Blog\Domain\ValueObjects\AuthorBirthday;
use Blog\Domain\ValueObjects\AuthorEmail;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\AuthorName;
use Blog\Domain\ValueObjects\AuthorPhone;

class Author
{
    private AuthorId $id;
    private AuthorName $name;
    private AuthorEmail $email;
    private AuthorPhone $phone;
    private AuthorBirthday $birthday;

    public function __construct(AuthorId $id, AuthorName $name, AuthorEmail $email, AuthorPhone $phone, AuthorBirthday $birthday)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->birthday = $birthday;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): AuthorName
    {
        return $this->name;
    }

    public function getEmail(): AuthorEmail
    {
        return $this->email;
    }

    public function getPhone(): AuthorPhone
    {
        return $this->phone;
    }

    public function getBirthday(): AuthorBirthday
    {
        return $this->birthday;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id->getValue(),
            "name" => $this->name->getValue(),
            "email" => $this->email->getValue(),
            "phone" => $this->phone->getValue(),
            "birthday" => $this->birthday->getValue(),
        ];
    }
}
