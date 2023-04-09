<?php

namespace Blog\Domain;

use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\ValueObjects\AuthorId;

interface AuthorRepositoryInterface
{
    /**
     * @throws AuthorNotFoundException
     */
    public function FindAuthorById(AuthorId $authorId): Author;
}
