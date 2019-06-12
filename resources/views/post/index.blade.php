@extends('layouts.app')
@section('body')
    <div class="container">
        @foreach($posts as $post)
            <div class="card mb-5">
                <div class="card-header">
                    {{ $post->user->name }} posted.
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <button class="btn btn-primary">Like</button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
