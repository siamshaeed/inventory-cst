@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('permissions.create') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Create Permissions') }}">{{ __('Create Permissions') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('permissions.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="View Permissions"><i class="fa fa-home"></i> Permissions</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <form id="addFormData" class="mt-4">
                    {{ csrf_field() }}

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Plan Name ...">
                            <span class="text-warning">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Guard Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="guard_name" name="guard_name" value="{{ old('guard_name') }}" class="form-control" placeholder="Enter Guard Name ...">
                            <span class="text-warning">{{ $errors->first('guard_name') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="submit" class="col-sm-2 col-form-label text-end"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-secondary btn-submit">Submit</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            $(".btn-submit").click(function (e){
                e.preventDefault();

                var _token      = $("input[name='_token']").val();
                var name        = $("#name").val();
                var guard_name  = $("#guard_name").val();
                //alert(description);

                $.ajax({
                    url: "{{ route('permissions.store') }}",
                    type:'POST',
                    data: {
                        _token: _token,
                        name: name,
                        price: guard_name,
                    },

                    success: function(response) {
                        if(response.status == 400){
                            //console.log(response.errors.name);
                            $.each(response.errors, function (key, err_values){
                                "use strict";
                                iziToast.error({
                                    message: err_values,
                                    position: 'topRight'
                                });
                            });

                        }else{
                            //alert(response.success);
                            $('#addFormData').find('input').val("");
                            $('#addFormData').find('textarea').val("");
                            $('#duration_type').val("");

                            "use strict";
                            iziToast.success({
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    }

                });

            });

        });
    </script>
@endpush
