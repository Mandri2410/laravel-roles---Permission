@extends('layouts.app')
@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Add New Mahasiswa</div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="mb-3">
                 <label for="roles" class="form-label">Roles</label>
                <select class="form-select" id="roles" name="roles[]">
                    @foreach ($roles as $role)
                        <option value="mahasiswa" {{ in_array('mahasiswa', old('roles') ?? []) ? 'selected' : '' }}>Mahasiswa</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Mahasiswa</button>
        </form>
    </div>
</div>
@endsection
