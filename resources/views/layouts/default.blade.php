<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield(config('larabanner.sections.title', 'title'))</title>
    @yield(config('larabanner.sections.styles', 'styles'))
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('larabanner.index') }}">Banner Management</a>
    </div>
</nav>

<div class="container">
    @yield(config('larabanner.sections.content', 'content'))
</div>

@yield(config('larabanner.sections.scripts', 'scripts'))
</body>
</html>
