<?php

namespace Tests\Unit\Blog\Application;

use Blog\Application\FindPostByIdQuery;
use Blog\Application\FindPostByIdQueryHandler;
use Blog\Domain\Exceptions\PostNotFoundException;
use Blog\Domain\Post;
use Blog\Domain\ValueObjects\PostId;
use Blog\Infrastructure\StaticAuthorRepository;
use Blog\Infrastructure\StaticPostRepository;
use PHPUnit\Framework\TestCase;

class FindPostByIdQueryHandlerTest extends TestCase
{
    private FindPostByIdQueryHandler $handler;

    private string $existPostId = "0678dd64-d633-11ed-afa1-0242ac120002";
    private string $notExistPostId = "13df846e-d6e0-11ed-afa1-0242ac120002";

    protected function setUp(): void
    {
        $this->handler = new FindPostByIdQueryHandler(new StaticPostRepository(new StaticAuthorRepository()));

        parent::setUp();
    }

    public function test_handle_post_id_exists_should_return_a_post()
    {
        $findPostByIdQuery = new FindPostByIdQuery(PostId::generate($this->existPostId));

        $post = $this->handler->handle($findPostByIdQuery);

        $this->assertInstanceOf(Post::class, $post);
    }

    public function test_handle_post_id_not_exists_should_throw_an_exception()
    {
        $findPostByIdQuery = new FindPostByIdQuery(PostId::generate($this->notExistPostId));

        $this->expectException(PostNotFoundException::class);

        $this->handler->handle($findPostByIdQuery);
    }
}
