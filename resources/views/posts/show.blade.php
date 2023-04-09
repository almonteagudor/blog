@extends('layouts.app')

@section('title', ' - Posts')

@section('body')
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{$post->getTitle()->getValue()}}</h5>
        <p class="card-text">{{$post->getBody()->getValue()}}</p>
    </div>
    <div class="card-footer">
        Author: {{$post->getAuthor()->getName()->getValue()}}
    </div>
</div>
@endsection
