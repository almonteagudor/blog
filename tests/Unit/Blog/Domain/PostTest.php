<?php

namespace Tests\Unit\Blog\Domain;

use Blog\Domain\Author;
use Blog\Domain\Post;
use Blog\Domain\ValueObjects\AuthorBirthday;
use Blog\Domain\ValueObjects\AuthorEmail;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\AuthorName;
use Blog\Domain\ValueObjects\AuthorPhone;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostId;
use Blog\Domain\ValueObjects\PostTitle;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    private Post $post;

    private string $postId = "bc65a7a8-d555-11ed-afa1-0242ac120002";
    private string $postTitle = "Post title";
    private string $postBody = "Post body";

    private Author $author;

    private string $authorId = "69afdc7c-d541-11ed-afa1-0242ac120002";
    private string $authorName = "Alberto";
    private string $authorEmail = "alberto@mail.com";
    private string $authorPhone = "654321987";
    private string $authorBirthday = "14/01/1990";

    protected function setUp(): void
    {
        $this->author = new Author(
            AuthorId::generate($this->authorId),
            AuthorName::generate($this->authorName),
            AuthorEmail::generate($this->authorEmail),
            AuthorPhone::generate($this->authorPhone),
            AuthorBirthday::generate($this->authorBirthday)
        );

        $this->post = new Post(
            PostId::generate($this->postId),
            PostTitle::generate($this->postTitle),
            PostBody::generate($this->postBody),
            $this->author
        );

        parent::setUp();
    }

    public function test_getId()
    {
        self::assertEquals($this->postId, $this->post->getId()->getValue());
    }

    public function test_getTitle()
    {
        self::assertEquals($this->postTitle, $this->post->getTitle()->getValue());
    }

    public function test_getBody()
    {
        self::assertEquals($this->postBody, $this->post->getBody()->getValue());
    }

    public function test_getAuthor()
    {
        self::assertEquals($this->author->getId()->getValue(), $this->post->getAuthor()->getId()->getValue());
    }
}
