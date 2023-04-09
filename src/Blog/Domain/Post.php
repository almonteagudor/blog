<?php

namespace Blog\Domain;

use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostId;
use Blog\Domain\ValueObjects\PostTitle;

class Post
{
    private PostId $id;
    private PostTitle $title;
    private PostBody $body;
    private Author $author;

    public function __construct(PostId $id, PostTitle $title, PostBody $body, Author $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getBody(): PostBody
    {
        return $this->body;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id->getValue(),
            "title" => $this->title->getValue(),
            "body" => $this->body->getValue(),
            "author" => $this->author->toArray(),
        ];
    }
}
