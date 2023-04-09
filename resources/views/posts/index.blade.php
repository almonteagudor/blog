@extends('layouts.app')

@section('title', ' - Posts')

@section('body')
<h1>POSTS</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Author</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{$post->getId()->getValue()}}</th>
            <td>{{$post->getTitle()->getValue()}}</td>
            <td>{{$post->getBody()->getValue()}}</td>
            <td>{{$post->getAuthor()->getName()->getValue()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
