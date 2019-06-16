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
                    <button type="button" data-like="{{ $post->like }}" data-post="{{ $post->id }}" class="btn {{ $post->like ? 'btn-primary' : 'btn-secondary' }}">
                        <span data-count="{{ $post->likes_count }}">{{ $post->likes_count }}</span> Like
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $('button').on('click', function (e) {
            e.preventDefault();
            let isLike = e.target.dataset.like;
            if (isLike) {
                unlike(e);
                return;
            }
            like(e);
        });

        function like(e) {
            axios.post(`/like/${e.target.dataset.post}`)
                .then(
                    e.target.dataset.like = true,
                    e.target.classList.remove('btn-secondary'),
                    e.target.classList.add('btn-primary'),
                    e.target.firstElementChild.innerText++,
                );
        }

        function unlike(e) {
            axios.delete(`/like/${e.target.dataset.post}`)
                .then(
                    e.target.dataset.like = "",
                    e.target.classList.remove('btn-primary'),
                    e.target.classList.add('btn-secondary'),
                    e.target.firstElementChild.innerText--,
                );
        }
    </script>
@endsection
