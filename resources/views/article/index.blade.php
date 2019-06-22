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
                unlike(e.target);
                return;
            }
            like(e.target);
        });

        function like(target) {
            axios.post(`/like/article/${target.dataset.article}`)
                .then(
                    target.dataset.like = true,
                    target.classList.remove('btn-secondary'),
                    target.classList.add('btn-primary'),
                    target.firstElementChild.innerText++,
                );
        }

        function unlike(target) {
            axios.delete(`/like/article/${target.dataset.article}`)
                .then(
                    target.dataset.like = "",
                    target.classList.remove('btn-primary'),
                    target.classList.add('btn-secondary'),
                    target.firstElementChild.innerText--,
                );
        }
    </script>
@endsection
