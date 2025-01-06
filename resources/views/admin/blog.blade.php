@extends('template/admin')
@section('title', 'Halaman Admin - Blog')
@section('page_name', 'Halaman Admin - Blog')
@section('data_name', 'Data Blog')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Blog</h3>
        <a href="{{ route('blog.create') }}" class="btn btn-success float-right"><i class="fa-solid fa-plus"></i> Tambah Blog</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="example2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Blog</th>
                   
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $index => $blog)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->created_at->format('d M Y') }}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('blog.destroy',$blog->id) }}" method="POST">
                                <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="btn btn-sm btn-primary">LIHAT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
