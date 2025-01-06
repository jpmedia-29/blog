@extends('template.front')
@section('title','Home')
@section('content')
    <div class="row">
        @foreach($blogs as $blog)
        <div class="col-md-4 mb-4">
            <div class="card h-100"> 
                @if($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="Gambar Blog">
                @else
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Placeholder">
                @endif
                <div class="card-body d-flex flex-column"> 
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{!! Str::limit($blog->content, 75) !!}</p>
                    <p class="card-text"><strong>Penulis:</strong> {{ $blog->author_name }}</p> 
                    <a href="{{ route('blog.detail', $blog->slug) }}" class="btn btn-primary btn-sm mt-auto">Baca Selengkapnya</a> 
                </div>
                <div class="card-footer text-muted">
                    {{ $blog->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
