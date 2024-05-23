@extends('layouts.app')
@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Permission Information
                </div>
                <div class="float-end">
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Permission Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $permission->name }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $permission->description }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Roles:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @forelse ($permission->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                        @empty
                        <span>No roles assigned.</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection