<?php

namespace Tests\Unit\Blog\Application;

use Blog\Application\GetAllPostsQuery;
use Blog\Application\GetAllPostsQueryHandler;
use Blog\Infrastructure\StaticAuthorRepository;
use Blog\Infrastructure\StaticPostRepository;
use PHPUnit\Framework\TestCase;

class GetAllPostsQueryHandlerTest extends TestCase
{
    private GetAllPostsQueryHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new GetAllPostsQueryHandler(new StaticPostRepository(new StaticAuthorRepository()));

        parent::setUp();
    }

    public function test_handle_should_return_an_post_array()
    {
        $getAllPostsQuery = new GetAllPostsQuery();

        $posts = $this->handler->handle($getAllPostsQuery);

        $this->assertIsArray($posts);
    }
}
