@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('plan.edit', $plan->id) }}" class="link" data-bs-toggle="tooltip" title="{{ __('Edit Plan') }}">{{ __('Edit Plan') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('plan.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Plan"><i class="fa fa-home"></i> Plan</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <form action="{{ route('plan.update', $plan->id) }}" method="post" enctype="multipart/form-data" class="mt-4">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" value="{{ $plan->name }}" class="form-control" placeholder="Enter Plan Name ...">
                            <span class="text-warning">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label text-end">Price</label>
                        <div class="col-sm-10">
                            <input type="number" id="price" name="price" value="{{ $plan->price }}" class="form-control" placeholder="00.00">
                            <span class="text-warning">{{ $errors->first('price') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_ays" class="col-sm-2 col-form-label text-end">Total Days</label>
                        <div class="col-sm-10">
                            <input type="number" id="total_days" name="total_days" value="{{ $plan->total_days }}" class="form-control" placeholder="00.00">
                            <span class="text-warning">{{ $errors->first('total_days') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="duration_type" class="col-sm-2 col-form-label text-end">Duration Type</label>
                        <div class="col-sm-10">
                            <select id="duration_type" name="duration_type" class="form-control">
                                <option value="1" {{ ($plan->duration_type == 1) ? 'selected' : '' }}>Daily</option>
                                <option value="2" {{ ($plan->duration_type == 2) ? 'selected' : '' }}>Weekly</option>
                                <option value="3" {{ ($plan->duration_type == 3) ? 'selected' : '' }}>Monthly</option>
                                <option value="4" {{ ($plan->duration_type == 4) ? 'selected' : '' }}>Yearly</option>
                            </select>
                            <span class="text-warning">{{ $errors->first('duration_type')  }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="trial_days" class="col-sm-2 col-form-label text-end">Trial Days</label>
                        <div class="col-sm-10">
                            <input type="number" id="trial_days" name="trial_days" value="{{ $plan->trial_days }}" class="form-control" placeholder="00.00">
                            <span class="text-warning">{{ $errors->first('trial_days') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label text-end">Description</label>
                        <div class="col-sm-10">
                            <textarea id="description" name="description" cols="30" rows="4" class="form-control">{{ $plan->description }}</textarea>
                            <span class="text-warning">{{ $errors->first('description') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="trial_days" class="col-sm-2 col-form-label text-end">Status</label>
                        <div class="col-sm-10">
                            <div class="form-check form-switch">
                                @if($plan->status)
                                    <input type="checkbox" id="status" name="status" class="form-check-input input-group-lg" role="switch" checked style="height: 1.5rem; width: 2.7rem;">
                                @else
                                    <input type="checkbox" id="status" name="status" class="form-check-input input-group-lg" role="switch" style="height: 1.5rem; width: 2.7rem;">
                                @endif
                            </div>
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
