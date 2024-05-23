@extends('layouts.app')
@extends('layouts.backend')

@section('content')

<div class="card">
    <div class="card-header">Manage Permissions</div>
    <div class="card-body">
        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm mb-3"><i class="bi bi-plus-circle"></i> Add New Permission</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Permission Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        @foreach ($permission->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this permission?')"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No permissions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $permissions->links() }}
    </div>
</div>
@endsection