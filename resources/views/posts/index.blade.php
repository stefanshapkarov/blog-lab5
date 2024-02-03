<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <h1 class="text-primary fw-bold">All posts</h1>
        <div class="mt-3">
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <p class="card-text"><small class="text-muted">Posted by {{ $post->user->name ?? 'Unknown' }}</small></p>
                        @if(auth()->user()->id == $post->user_id)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                        @endif
                        {{-- Display comments --}}
                        @foreach ($post->comments as $comment)
                            <div>{{ $comment->body }} - <small>By {{ $comment->user->name }}</small></div>
                        @endforeach

                        {{-- Comment form --}}
                        <form method="POST" action="{{ route('comments.store', $post) }}">
                            @csrf
                            <textarea name="body" required></textarea>
                            <button type="submit" class="btn btn-dark text-dark">Add Comment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div><br>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
