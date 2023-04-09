<?php

declare(strict_types=1);

namespace Blog\Application;

use Blog\Domain\ValueObjects\PostId;

class FindPostByIdQuery
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
