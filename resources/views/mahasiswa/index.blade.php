@extends('layouts.app')
@extends('layouts.backend')

@section('content')

<div class="card">
    <div class="card-header">Manage Mahasiswa</div>
    <div class="card-body">
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-success btn-sm mb-3"><i class="bi bi-plus-circle"></i> Add New Mahasiswa</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mahasiswa->name }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>
                        @foreach ($mahasiswa->getRoleNames() as $role)
                            <span class="badge bg-primary">{{ $role }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this mahasiswa?')"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No mahasiswa found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $mahasiswas->links() }}
    </div>
</div>
@endsection
