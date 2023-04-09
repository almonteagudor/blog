<?php

declare(strict_types=1);

namespace Blog\Infrastructure;

use Blog\Domain\Author;
use Blog\Domain\AuthorRepositoryInterface;
use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\ValueObjects\AuthorBirthday;
use Blog\Domain\ValueObjects\AuthorEmail;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\AuthorName;
use Blog\Domain\ValueObjects\AuthorPhone;

class StaticAuthorRepository implements AuthorRepositoryInterface
{
    private array $data = [
        [
            "id" => "0678e2aa-d633-11ed-afa1-0242ac120002",
            "name" => "Alberto",
            "email" => "alberto@email.com",
            "phone" => "654987321",
            "birthday" =>"14/01/1990",
        ],
        [
            "id" => "0678e458-d633-11ed-afa1-0242ac120002",
            "name" => "María",
            "email" => "maria@email.com",
            "phone" => "654987321",
            "birthday" =>"14/01/1990",
        ]
    ];

    /**
     * @inheritDoc
     */
    public function FindAuthorById(AuthorId $authorId): Author
    {
        foreach ($this->data as $dataAuthor) {
            if ($dataAuthor["id"] == $authorId->getValue()) {
                return new Author(
                    AuthorId::generate($dataAuthor["id"]),
                    AuthorName::generate($dataAuthor["name"]),
                    AuthorEmail::generate($dataAuthor["email"]),
                    AuthorPhone::generate($dataAuthor["phone"]),
                    AuthorBirthday::generate($dataAuthor["birthday"]),
                );
            }
        }

        throw new AuthorNotFoundException("Author not found");
    }
}
