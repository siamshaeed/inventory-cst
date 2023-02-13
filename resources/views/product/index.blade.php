@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('product.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Product View') }}">{{ __('Product') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('product.create') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Create New"><i class="fa fa-plus"></i> Create</a>
                    {{--@can('create')
                        <a href="{{ route('product.create') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Create New"><i class="fa fa-plus"></i> Create</a>
                    @endcan--}}
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col">{{ __("Image") }}</th>
                            <th scope="col">{{ __("Product Name") }}</th>
                            <th scope="col">{{ __("Model") }}</th>
                            <th scope="col">{{ __("Brand Name") }}</th>
                            <th scope="col">{{ __("Category Name") }}</th>
                            <th scope="col" data-toggle="tooltip" title="How many products are available">{{ __("Stock") }}</th>
                            <th scope="col">{{ __("Status") }}</th>
                            <th scope="col">{{ __("Operation") }}</th>
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
                ajax: '{{ route("product.list", 1) }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_image', name: 'define_image'},
                    {data: 'define_name', name: 'define_name'},
                    {data: 'model', name: 'model'},
                    {data: 'define_brand_name', name: 'define_brand_name'},
                    {data: 'define_category_name', name: 'define_category_name'},
                    {data: 'define_stock', name: 'define_stock'},
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

