@extends('template.admin')
@section('title', 'Edit Blog')
@section('page_name', 'Edit Blog')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Blog</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Blog</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $blog->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Konten Blog</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="summernote" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Foto Blog</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($blog->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($blog->image) }}" alt="Gambar Blog" class="img-fluid" width="200">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success float-right">Update Blog</button>
        </form>
    </div>
</div>

@endsection
