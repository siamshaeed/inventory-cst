@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="link" data-bs-toggle="tooltip" title="{{ __('Edit Permissions') }}">{{ __('Edit Permissions') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('permissions.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="{{ __('View Permissions') }}"><i class="fa fa-home"></i> Permissions</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <form action="{{ route('permissions.update', $permission->id) }}" method="post" enctype="multipart/form-data" class="mt-4">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" value="{{ $permission->name }}" class="form-control">
                            <span class="text-warning">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="guard_name" class="col-sm-2 col-form-label text-end">Guard Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="guard_name" name="guard_name" value="{{ $permission->guard_name }}" class="form-control"guard_name>
                            <span class="text-warning">{{ $errors->first('guard_name') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="submit" class="col-sm-2 col-form-label text-end"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
