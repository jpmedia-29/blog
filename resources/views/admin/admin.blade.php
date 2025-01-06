@extends('template.admin')
@section('title', 'Kelola Data Admin')
@section('page_name', 'Kelola Data Admin')
@section('data_name', 'Data Admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Admin</h3>
            <a href="{{ route('admin.create') }}" class="btn btn-success float-right"><i class="fa-solid fa-plus"></i> Tambah Admin</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="example2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as  $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td>{{ $admin->created_at->format('d M Y') }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                    <a href="{{ route('admin.edit', $admin->id ) }}" class="btn btn-sm btn-primary">EDIT</a>
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
