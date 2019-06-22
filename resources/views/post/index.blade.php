@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
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
            axios.post(`/like/post/${target.data('post')}`)
                .then(
                    target.data('like', true),
                    target.removeClass('btn-secondary'),
                    target.addClass('btn-primary'),
                    target.find('span').text(parseInt(target.find('span').text()) + 1),
                );
        }

        function unlike(target) {
            axios.delete(`/like/post/${target.data('post')}`)
                .then(
                    target.data('like', ""),
                    target.removeClass('btn-primary'),
                    target.addClass('btn-secondary'),
                    target.find('span').text(parseInt(target.find('span').text()) - 1),
                );
        }
    </script>
@endsection
