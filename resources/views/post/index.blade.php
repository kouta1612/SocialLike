@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $post->user->name }} posted.
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <form action="/like" method="POST">
                        @csrf
                        <input type="hidden" name="postid">
                        <button class="btn btn-primary">Like</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
