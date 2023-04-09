<?php

namespace App\Http\Controllers;

use Blog\Application\CreatePostCommand;
use Blog\Application\CreatePostCommandHandler;
use Blog\Application\FindPostByIdQuery;
use Blog\Application\FindPostByIdQueryHandler;
use Blog\Application\GetAllPostsQuery;
use Blog\Application\GetAllPostsQueryHandler;
use Blog\Domain\Exceptions\AuthorNotFoundException;
use Blog\Domain\Exceptions\InvalidValueException;
use Blog\Domain\ValueObjects\AuthorId;
use Blog\Domain\ValueObjects\PostBody;
use Blog\Domain\ValueObjects\PostId;
use Blog\Domain\ValueObjects\PostTitle;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function __construct()
    {
    }

    public function index(GetAllPostsQueryHandler $handler): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = $handler->handle(new GetAllPostsQuery());

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(string $id, FindPostByIdQueryHandler $handler): View|Application|Factory|string|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $postId = PostId::generate($id);
        } catch (InvalidValueException $e) {
            return $e->getMessage();
        }

        $post = $handler->handle(new FindPostByIdQuery($postId));

        return view('posts.show', ['post' => $post]);
    }

    public function create(Request $request, CreatePostCommandHandler $handler)
    {
        try {
            $data = $request->validate(['title' => 'required', 'body' => 'required', 'authorId' => 'required']);

            $post = $handler->handle(new CreatePostCommand(
                PostTitle::generate($data["title"]),
                PostBody::generate($data["body"]),
                AuthorId::generate($data["authorId"]),
            ));
        } catch (ValidationException $e) {
            return $e->validator->getMessageBag()->getMessages();
        } catch (InvalidValueException|AuthorNotFoundException $e) {
            return $e->getMessage();
        }


        return $post->toArray();
    }

    public function getAllPosts(GetAllPostsQueryHandler $handler): array
    {
        $posts = $handler->handle(new GetAllPostsQuery());

        return array_map(function ($post) {
            return $post->toArray();
        }, $posts);
    }
}
