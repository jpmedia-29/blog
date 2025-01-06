@extends('template.front')
@section('title','Blog Detail')
@section('content')

<div class="card">
    @if($blog->image)
        <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="Gambar Blog" style="max-width: 100%; height: auto;">
    @else
        <img src="https://via.placeholder.com/20x70" class="card-img-top" alt="Placeholder" style="max-width: 100%; height: auto;">
    @endif

    <div class="card-body">
        <h3 class="card-title">{{ $blog->title }}</h3>
        <p class="card-text">{!! $blog->content !!}</p>
        <p class="card-text"><strong>Penulis:</strong> {{ $blog->author_name }}</p>

        <button id="like-btn" data-blog-id="{{ $blog->id }}" class="btn btn-primary">
            <i class="fa-regular fa-thumbs-up" id="like-icon"></i> <span id="like-count">{{ $blog->like_count }}</span> Likes
        </button>
    </div>

    <div class="card-footer text-muted">
        <small>Diposting {{ $blog->created_at->diffForHumans() }}</small>
    </div>
</div>

<!-- Form Komentar -->
<div class="mt-5">
    <h4>Tambah Komentar</h4>
    <form action="{{ route('comments.store', $blog->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar Anda" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
    </form>
</div>

<!-- Daftar Komentar -->
<div class="mt-5">
    <h4>Komentar</h4>

    @foreach($blog->comments as $comment)
        @if($comment->parent_id === null) 
        <div class="media mb-4" id="comment-{{ $comment->id }}">
            <img src="https://via.placeholder.com/50" class="mr-3" alt="User">
            <div class="media-body">
                <h5 class="mt-0">{{ $comment->user->name }}</h5>
                <p>{{ $comment->content }}</p>

                <!-- Balasan Komentar -->
                @foreach($comment->replies as $reply)
                    <div class="media mt-3">
                        <img src="https://via.placeholder.com/50" class="mr-3" alt="User">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $reply->user->name }}</h5>
                            <p>{{ $reply->content }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Form Balasan -->
                <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="2" placeholder="Balas komentar ini" required></textarea>
                    </div>
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <button type="submit" class="btn btn-sm btn-secondary">Balas</button>
                </form>
            </div>
        </div>
        @endif
    @endforeach
</div>


@endsection
