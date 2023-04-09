<?php

namespace Tests\Unit\Blog\Application;

use Blog\Application\CreatePostCommand;
use Blog\Application\CreatePostCommandHandler;
use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\Post;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostTitle;
use Blog\Infrastructure\StaticAuthorRepository;
use Blog\Infrastructure\StaticPostRepository;
use PHPUnit\Framework\TestCase;

class CreatePostCommandHandlerTest extends TestCase
{
    private CreatePostCommandHandler $handler;

    private string $postTitle = "Post title";
    private string $postBody = "Post body";
    private string $existAuthorId = "0678e2aa-d633-11ed-afa1-0242ac120002";
    private string $notExistAuthorId = "13df846e-d6e0-11ed-afa1-0242ac120002";

    protected function setUp(): void
    {
        $this->handler = new CreatePostCommandHandler(new StaticPostRepository(new StaticAuthorRepository()), new StaticAuthorRepository());

        parent::setUp();
    }

    public function test_handle_author_id_exists_should_return_an_author()
    {
        $createPostCommand = new CreatePostCommand(
            PostTitle::generate($this->postTitle),
            PostBody::generate($this->postBody),
            AuthorId::generate($this->existAuthorId),
        );

        $post = $this->handler->handle($createPostCommand);

        $this->assertInstanceOf(Post::class, $post);
    }

    public function test_handle_author_id_not_exists_should_throw_an_exception()
    {
        $createPostCommand = new CreatePostCommand(
            PostTitle::generate($this->postTitle),
            PostBody::generate($this->postBody),
            AuthorId::generate($this->notExistAuthorId),
        );

        $this->expectException(AuthorNotFoundException::class);

        $this->handler->handle($createPostCommand);
    }
}
