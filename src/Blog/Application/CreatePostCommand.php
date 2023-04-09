<?php

declare(strict_types=1);

namespace Blog\Application;

use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostTitle;

class CreatePostCommand
{
    private PostTitle $title;
    private PostBody $body;
    private AuthorId $authorId;

    public function __construct(PostTitle $title,PostBody $body, AuthorId $authorId)
    {
        $this->title = $title;
        $this->body = $body;
        $this->authorId = $authorId;
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getBody(): PostBody
    {
        return $this->body;
    }

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }
}
