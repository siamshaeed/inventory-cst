@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('purchase-item.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Purchase Items View') }}">{{ __('Purchase Items') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('purchase.create') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Create New Purchase"><i class="fa fa-plus"></i> Create Purchase</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col">{{ __("CreatedAt") }}</th>
                            <th scope="col" style="width: 600px;">{{ __("Product Name") }}</th>

                            <th scope="col" data-toggle="tooltip" title="Stock In">{{ __("Stock In") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Stock Out">{{ __("Stock Out") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Stock Available">{{ __("Available") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Stock Status">{{ __("Status") }}</th>

                            <th scope="col">{{ __("Quantity") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Buying Price">{{ __("Unit Price") }}</th>
                            <th scope="col">{{ __("Discount") }}</th>
                            <th scope="col">{{ __("Sub Total") }}</th>
                            <th scope="col">{{ __("Selling Price") }}</th>
                            {{--<th scope="col">{{ __("Action") }}</th>--}}
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
                ajax: '{{ route("purchase-item.index") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_date', name: 'define_date'},
                    {data: 'define_name', name: 'define_name'},

                    {data: 'define_stock_in', name: 'define_stock_in'},
                    {data: 'stock_out', name: 'stock_out'},
                    {data: 'define_stock_available', name: 'define_stock_available'},
                    {data: 'define_stock_status', name: 'define_stock_status'},

                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit_price', name: 'unit_price'},
                    {data: 'discount', name: 'discount'},
                    {data: 'sub_total', name: 'sub_total'},
                    {data: 'selling_price', name: 'selling_price'},
                    /*{data: 'action', name: 'action', orderable: false, searchable: false}*/
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

