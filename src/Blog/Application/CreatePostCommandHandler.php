<?php

declare(strict_types=1);

namespace Blog\Application;

use Blog\Domain\AuthorRepositoryInterface;
use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\Post;
use Blog\Domain\PostRepositoryInterface;
use Blog\Domain\ValueObjects\PostId;

class CreatePostCommandHandler
{
    private PostRepositoryInterface $postRepository;
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(PostRepositoryInterface $postRepository, AuthorRepositoryInterface $authorRepository)
    {
        $this->postRepository = $postRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function handle(CreatePostCommand $createPostCommand): Post
    {
        $author = $this->authorRepository->FindAuthorById($createPostCommand->getAuthorId());

        $post = new Post(
            PostId::generateRandom(),
            $createPostCommand->getTitle(),
            $createPostCommand->getBody(),
            $author
        );

        $this->postRepository->InsertPost($post);

        return $post;
    }
}
