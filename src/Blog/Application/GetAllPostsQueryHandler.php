<?php

declare(strict_types=1);

namespace Blog\Application;

use Blog\Domain\Post;
use Blog\Domain\PostRepositoryInterface;

class GetAllPostsQueryHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return Post[]
     */
    public function handle(GetAllPostsQuery $getAllPostsQuery): array
    {
        return $this->postRepository->getAllPosts();
    }
}
