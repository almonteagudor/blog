<?php

declare(strict_types=1);

namespace Blog\Application;

use Blog\Domain\Post;
use Blog\Domain\PostRepositoryInterface;

class FindPostByIdQueryHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(FindPostByIdQuery $findPostByIdQuery): Post
    {
        return $this->postRepository->FindPostById($findPostByIdQuery->getPostId());
    }
}
