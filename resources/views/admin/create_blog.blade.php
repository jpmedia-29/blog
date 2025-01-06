@extends('template.admin')
@section('title', 'Tambah Blog')
@section('page_name', 'Tambah Blog')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Blog Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Blog</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Konten Blog</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="summernote" rows="5" required>{{ old('content') }}</textarea>
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
            </div>

            <button type="submit" class="btn btn-success float-right">Simpan Blog</button>
        </form>
    </div>
</div>

@endsection
