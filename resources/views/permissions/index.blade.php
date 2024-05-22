@extends('layouts.app')
@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Manage Permissions</div>
    <div class="card-body">
        @can('create-permission')
        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Permission</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Guard Name</th>
                    <th scope="col" style="width: 250px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @can('edit-permission')
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan
                            @can('delete-permission')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this permission?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Permissions Found!</strong>
                        </span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $permissions->links() }}
    </div>
</div>
@endsection
