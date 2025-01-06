@extends('template.admin')
@section('title', 'Edit Admin')
@section('page_name', 'Edit Admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Admin</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="name">Nama Admin</label>
                <input type="hidden" name="role" value="admin">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $admin->name) }}" >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Admin</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $admin->email) }}" >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak ingin mengganti)</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update Admin</button>
        </form>
    </div>
</div>

@endsection
