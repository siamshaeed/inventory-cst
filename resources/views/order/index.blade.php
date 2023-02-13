@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('order.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Order View') }}">{{ __('Order') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('order.create') }}" class="ms-1 text-orange" data-bs-toggle="tooltip" title="Create New"><i class="fa fa-plus"></i> Create</a>
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Order Crated Date">{{ __("Generate") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Order Number">{{ __("Order Number") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Invoice Number">{{ __("Order Name") }}</th>

                            <th scope="col">{{ __("Grand Total") }}</th>
                            <th scope="col">{{ __("Discount") }}</th>
                            <th scope="col">{{ __("Total Amount") }}</th>
                            <th scope="col">{{ __("Order Status") }}</th>

                            <th scope="col">{{ __("Order Sale") }}</th>
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
                ajax: '{{ route("order.index") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_date', name: 'define_date'},
                    {data: 'define_order_number', name: 'define_order_number'},
                    {data: 'define_order_supplier_name', name: 'define_order_supplier_name'},

                    {data: 'grand_total', name: 'grand_total'},
                    {data: 'total_discount', name: 'total_discount'},
                    {data: 'define_total_amount', name: 'define_total_amount'},
                    {data: 'define_order_status', name: 'define_order_status'},

                    /*{data: 'action_edit_button', name: 'action_edit_button', orderable: false, searchable: false}*/
                    {data: 'define_order_sale', name: 'define_order_sale'},
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

