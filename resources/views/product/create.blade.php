@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip"
                           title="{{ __('Create ') }}">{{ __('Create Product') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('product.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       title="View Product"><i class="fa fa-home"></i> Product</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">
                <form class="mt-4" action="{{ route('product.store') }}" method="post" id="addFormData" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-10">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Product Name</b> <span class="text-warning" title="Must be Required">*</span></label>
                            <div class="col-sm-9">
                                <select name="good_id" class="form-control" required>
                                    <option value="">Select Goods Name</option>
                                    @foreach($goods as $good)
                                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-warning">{{ $errors->first('good_id') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Category</b> <span class="text-warning" title="Must be Required">*</span></label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-warning">{{ $errors->first('category_id') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Brand Name</b> <span class="text-warning" title="Must be Required">*</span></label>
                            <div class="col-sm-9">
                                <select name="brand_id" class="form-control" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-warning">{{ $errors->first('brand_id') }}</span>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Model Name</b> <span class="text-warning" title="Must be Required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="model" value="{{ old('model') }}" class="form-control" placeholder="Enter model number ..." required>
                                <span class="text-warning">{{ $errors->first('model') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Details</b></label>
                            <div class="col-sm-9">
                                <textarea name="details" class="form-control" cols="30" rows="3" placeholder="Write product details...">{{ old('details') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label text-end"><b>Image</b></label>
                            <div class="col-sm-9">
                                <input type="file" name="image" value="{{ old('image') }}" class="form-control" >
                                <span class="text-warning">{{ $errors->first('image') }}</span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-secondary modal_form_submit col-sm-2">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
