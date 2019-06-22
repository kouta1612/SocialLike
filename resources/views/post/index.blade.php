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
            let isLike = e.target.dataset.like;
            
            if (isLike) {
                unlike(e.target);
                return;
            }
            like(e.target);
        });

        function like(target) {
            axios.post(`/like/post/${target.dataset.post}`)
                .then(
                    target.dataset.like = true,
                    target.classList.remove('btn-secondary'),
                    target.classList.add('btn-primary'),
                    target.firstElementChild.innerText++,
                )
        }

        function unlike(target) {
            axios.delete(`/like/post/${target.dataset.post}`)
                .then(
                    target.dataset.like = "",
                    target.classList.remove('btn-primary'),
                    target.classList.add('btn-secondary'),
                    target.firstElementChild.innerText--,
                );
        }
    </script>
@endsection
