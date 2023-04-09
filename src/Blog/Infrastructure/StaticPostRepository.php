<?php

declare(strict_types=1);

namespace Blog\Infrastructure;

use Blog\Domain\AuthorRepositoryInterface;
use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\Exceptions\PostNotFoundException;
use Blog\Domain\Post;
use Blog\Domain\PostRepositoryInterface;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostId;
use Blog\Domain\ValueObjects\PostTitle;

class StaticPostRepository implements PostRepositoryInterface
{
    private AuthorRepositoryInterface $authorRepository;

    private array $data = [
        [
            "id" => "0678d558-d633-11ed-afa1-0242ac120002",
            "title" => "Title 1",
            "body" => "Body 1",
            "authorId" => "0678e2aa-d633-11ed-afa1-0242ac120002",
        ],
        [
            "id" => "0678dd64-d633-11ed-afa1-0242ac120002",
            "title" => "Title 2",
            "body" => "Body 2",
            "authorId" => "0678e458-d633-11ed-afa1-0242ac120002",
        ],
        [
            "id" => "0678df44-d633-11ed-afa1-0242ac120002",
            "title" => "Title 3",
            "body" => "Body 3",
            "authorId" => "0678e2aa-d633-11ed-afa1-0242ac120002",
        ],
        [
            "id" => "0678e0fc-d633-11ed-afa1-0242ac120002",
            "title" => "Title 4",
            "body" => "Body 4",
            "authorId" => "0678e2aa-d633-11ed-afa1-0242ac120002",
        ],
    ];

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllPosts(): array
    {
        $posts = [];

        foreach ($this->data as $dataPost) {
            $author = $this->authorRepository->FindAuthorById(AuthorId::generate($dataPost["authorId"]));

            $posts[] = new Post(
                PostId::generate($dataPost["id"]),
                PostTitle::generate($dataPost["title"]),
                PostBody::generate($dataPost["body"]),
                $author
            );
        }

        return $posts;
    }

    /**
     * @inheritDoc
     * @throws AuthorNotFoundException
     * @throws InvalidValueException
     */
    public function FindPostById(PostId $postId): Post
    {
        foreach ($this->data as $dataPost) {
            if ($dataPost["id"] == $postId->getValue()) {
                $author = $this->authorRepository->FindAuthorById(AuthorId::generate($dataPost["authorId"]));

                return new Post(
                    PostId::generate($dataPost["id"]),
                    PostTitle::generate($dataPost["title"]),
                    PostBody::generate($dataPost["body"]),
                    $author
                );
            }
        }

        throw new PostNotFoundException("Post not found");
    }

    public function InsertPost(Post $post): bool
    {
        $this->data[] = [
            "id" => $post->getId()->getValue(),
            "title" => $post->getTitle()->getValue(),
            "body" => $post->getBody()->getValue(),
            "authorId" => $post->getAuthor()->getId()->getValue(),
        ];

        return true;
    }
}
