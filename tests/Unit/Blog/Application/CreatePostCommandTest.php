<?php

namespace Tests\Unit\Blog\Application;

use Blog\Application\CreatePostCommand;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostTitle;
use PHPUnit\Framework\TestCase;

class CreatePostCommandTest extends TestCase
{
    private CreatePostCommand $createPostCommand;

    private string $postTitle = "Post title";
    private string $postBody = "Post body";
    private string $authorId = "69afdc7c-d541-11ed-afa1-0242ac120002";

    protected function setUp(): void
    {
        $this->createPostCommand = new CreatePostCommand(
            PostTitle::generate($this->postTitle),
            PostBody::generate($this->postBody),
            AuthorId::generate($this->authorId),
        );

        parent::setUp();
    }

    public function test_getTitle()
    {
        self::assertEquals($this->postTitle, $this->createPostCommand->getTitle()->getValue());
    }

    public function test_getBody()
    {
        self::assertEquals($this->postBody, $this->createPostCommand->getBody()->getValue());
    }

    public function test_getAuthorId()
    {
        self::assertEquals($this->authorId, $this->createPostCommand->getAuthorId()->getValue());
    }
}
