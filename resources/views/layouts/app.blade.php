<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog - @yield('title')</title>

    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css"/>
</head>
<body>

@include('layouts.navbar')

<div class="container text-justify font-italic my-5">
    @yield('body')
</div>
</body>
</html>

