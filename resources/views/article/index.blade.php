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
            let isLike = $(this).data('like');
            if (isLike) {
                unlike($(this));
                return;
            }
            like($(this));
        });

        function like(target) {
            axios.post(`/like/article/${target.data('article')}`)
                .then(
                    target.data('like', true),
                    target.removeClass('btn-secondary'),
                    target.addClass('btn-primary'),
                    target.find('span').text(parseInt(target.find('span').text()) + 1),
                );
        }

        function unlike(target) {
            axios.delete(`/like/article/${target.data('article')}`)
                .then(
                    target.data('like', ""),
                    target.removeClass('btn-primary'),
                    target.addClass('btn-secondary'),
                    target.find('span').text(parseInt(target.find('span').text()) - 1),
                );
        }
    </script>
@endsection
