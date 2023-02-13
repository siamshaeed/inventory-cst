@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('market-type.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Market Type View') }}">{{ __('Market Type') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <button type="button" class="btn btn-sm btn-secondary show-modal"
                            data-route="{{ route('market-type.create') }}"
                            data-method="get"
                            data-action="view"
                            data-toggle="tooltip"
                            data-modal_title="Create Brand"
                            title="Create New">
                        <i class="fa fa-plus"></i>
                        Create
                    </button>
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col">{{ __("Name") }}</th>
                            <th scope="col">{{ __("Title") }}</th>
                            <th scope="col">{{ __("Status") }}</th>
                            <th scope="col">{{ __("Action") }}</th>
                        </tr>
                        </thead>
                        <tbody id="users_table"></tbody>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#custom-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,
                ajax: '{{ route("market-type.index") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data: 'define_status', name: 'define_status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]

            });
        });

        $.modalCallBackOnAnyChange = function () {
            dataTable.draw(false);
        }
    </script>

    {{--status change--}}
    @include('status.status_script')
@endpush

