@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($articles as $article)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $article->user->name }} posted.
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->content }}</p>
                    <button type="button" data-like="{{ $article->like }}" data-article="{{ $article->id }}" class="btn {{ $article->like ? 'btn-primary' : 'btn-secondary' }}">
                        <span data-count="{{ $article->likes_count }}">{{ $article->likes_count }}</span> Like
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
            axios.post(`/like/article/${e.target.dataset.article}`)
                .then(
                    e.target.dataset.like = true,
                    e.target.classList.remove('btn-secondary'),
                    e.target.classList.add('btn-primary'),
                    e.target.firstElementChild.innerText++,
                );
        }

        function unlike(e) {
            axios.delete(`/like/article/${e.target.dataset.article}`)
                .then(
                    e.target.dataset.like = "",
                    e.target.classList.remove('btn-primary'),
                    e.target.classList.add('btn-secondary'),
                    e.target.firstElementChild.innerText--,
                );
        }
    </script>
@endsection
