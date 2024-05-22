@extends('layouts.backend')

@section('title', 'Manage Permissions')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Permissions Index -->
                    <div class="card">
                        <div class="card-header">Permissions</div>
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

                    <!-- Permission Show -->
                    @isset($permission)
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="float-start">Permission Information</div>
                            <div class="float-end">
                                <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $permission->name }}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="guard_name" class="col-md-4 col-form-label text-md-end text-start"><strong>Guard Name:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $permission->guard_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
