<?php

namespace Tests\Unit\Blog\Application;

use Blog\Application\FindPostByIdQuery;
use Blog\Domain\ValueObjects\PostId;
use PHPUnit\Framework\TestCase;

class FindPostByIdQueryTest extends TestCase
{
    private FindPostByIdQuery $findPostByIdQuery;

    private string $postId = "69afdc7c-d541-11ed-afa1-0242ac120002";

    protected function setUp(): void
    {
        $this->findPostByIdQuery = new FindPostByIdQuery(PostId::generate($this->postId));

        parent::setUp();
    }

    public function test_getPostId()
    {
        self::assertEquals($this->postId, $this->findPostByIdQuery->getPostId()->getValue());
    }
}
