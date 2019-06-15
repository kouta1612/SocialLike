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
                    @if ($post->isLike())
                        <form action="/like/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="postid" value="{{ $post->id }}">
                            <button class="btn {{ $post->isLike() ? 'btn-primary' : 'btn-secondary' }}">
                                {{ $post->likesCount }} Like
                            </button>
                        </form>
                    @else
                        <form action="/like/{{ $post->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="postid" value="{{ $post->id }}">
                            <button class="btn {{ $post->isLike() ? 'btn-primary' : 'btn-secondary' }}">
                                {{ $post->likesCount }} Like
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
