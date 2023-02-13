@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('roles.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Role Management') }}">{{ __('Role Management') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('roles.create') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Create New Role"><i class="fa fa-plus"></i> Create</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col">{{ __("Role Name") }}</th>
                            <th scope="col">{{ __("Permission Access") }}</th>
                            <th scope="col">{{ __("Action") }}</th>
                        </tr>
                        </thead>
                        {{--<tbody id="users_table"></tbody>--}}

                        <tbody id="users_table">
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <strong>
                                        {{ $role->name }}
                                    </strong>
                                </td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </td>
                                <td class="text-right">
                                    {{--<a type="button" class="btn btn-primary btn-icon btn-sm"
                                       data-placement="top" title="" data-original-title="Edit"
                                       href="{{route('roles.edit', $role->id )}}"
                                       data-title="{{__("Role Edit")}}">
                                        <i class="fa fa-edit"></i>
                                    </a>--}}
                                    {{--<button type="button"
                                            class="btn btn-danger btn-icon btn-sm btn-datatable-row-action"
                                            data-toggle="tooltip"
                                            data-placement="top" title=""
                                            data-original-title="Delete"
                                            data-id="{{$role->id}}"
                                            data-url="{{route('roles.destroy', $role->id )}}"
                                            data-type="delete" data-title="Role Delete"
                                            data-message="Role Will be Deleted Permanently ">
                                        <i class="fa fa-trash"></i>
                                    </button>--}}


                                    <form method="POST" action="{{ route('roles.destroy', $role) }}">
                                        @csrf
                                        <a href="{{ route('roles.edit', [ $role->id ]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat- show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
{{--    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#custom-table').DataTable({

                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,
                ajax: '{{ route("permissions.index") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]

            });
        });

        $.modalCallBackOnAnyChange = function () {
            dataTable.draw(false);
        }
    </script>

    --}}{{--status change--}}{{--
    @include('status.status_script')--}}
@endpush

