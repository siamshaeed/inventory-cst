@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('users.create') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Create Role') }}">{{ __('Create Role') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('users.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Role"><i class="fa fa-home"></i> Role</a>
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
                        <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email ...">
                            <span class="text-warning">{{ $errors->first('email') }}</span>
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

                var _token = $("input[name='_token']").val();
                var name = $("#name").val();
                var price = $("#price").val();
                var total_days = $("#total_days").val();
                var duration_type = $("#duration_type").val();
                var trial_days = $("#trial_days").val();
                var description = $("#description").val();
                //alert(description);

                $.ajax({
                    url: "{{ route('users.store') }}",
                    type:'POST',
                    data: {
                        _token: _token,
                        name: name,
                        price: price,
                        total_days: total_days,
                        duration_type: duration_type,
                        trial_days: trial_days,
                        description: description,
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
