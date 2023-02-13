@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('roles.create') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Create Role') }}">{{ __('Create Role') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('roles.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="View Role"><i class="fa fa-home"></i> Role</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <form method="POST" action="{{route('roles.store')}}">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-md-2 form-control-label"
                               for="name">{{__('Name')}}</label>
                        <input type="text" class="col-md-10 form-control" id="name" name="name"
                               placeholder="{{__('Enter Name')}}" maxlength="191" required/>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label">{{__("Abilities")}}</label>

                        <div class="col-12 col-sm-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Permissions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if ($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox">
                                                        <label
                                                            for="{{'permission-'.$permission->id}}">
                                                            <input type="checkbox"
                                                                   name="permissions[]"
                                                                   id="{{'permission-'.$permission->id}}"
                                                                   {{ old('permissions') && in_array($permission->name, old('permissions'))?'checked':''}} value="{{$permission->name}}">
                                                            {{$permission->name}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--form-group-->
                    <button type="submit" class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path> <circle cx="12" cy="14" r="2"></circle> <polyline points="14 4 14 8 8 8 8 4"></polyline> </svg>
                        {{__("Submit")}}
                    </button>
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
