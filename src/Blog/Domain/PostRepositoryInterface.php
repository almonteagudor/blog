<?php

namespace Blog\Domain;

use Blog\Domain\Exceptions\PostNotFoundException;
use Blog\Domain\ValueObjects\PostId;

interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array;

    /**
     * @throws PostNotFoundException
     */
    public function FindPostById(PostId $postId): Post;

    public function InsertPost(Post $post): bool;
}
