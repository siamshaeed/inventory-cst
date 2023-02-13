@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('sale.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Sale Item View') }}">{{ __('Sale Item') }}</a>
                        Order Number: <b class="text-primary">{{ $sale->order->order_number }}</b>; OrderName: <b class="text-success">{{ $sale->order->supplier->name }}</b>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<button type="button" class="btn btn-sm btn-secondary show-modal"
                            data-route="{{ route('order-item.create.order', $sale_id) }}"
                            data-method="get"
                            data-action="view"
                            data-toggle="tooltip"
                            data-modal_title="Create Order Item"
                            title="Create New">
                        <i class="fa fa-plus"></i>
                        Create
                    </button>--}}
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Order Crated Date">{{ __("Order Created Date") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Order Product Name">{{ __("Product Name") }}</th>

                            <th scope="col">{{ __("Quantity") }}</th>
                            <th scope="col">{{ __("Unit Price") }}</th>
                            <th scope="col">{{ __("Discount") }}</th>
                            <th scope="col">{{ __("Sub Total") }}</th>

                            {{--<th scope="col">{{ __("Order Status") }}</th>--}}
                            {{--<th scope="col">{{ __("Operation") }}</th>--}}
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
                ajax: '{{ route("sale-item.show", $sale_id) }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_date', name: 'define_date'},
                    {data: 'define_product_name', name: 'define_product_name'},

                    {data: 'qty', name: 'qty'},
                    {data: 'unit_price', name: 'unit_price'},
                    {data: 'discount', name: 'discount'},
                    {data: 'define_sub_total', name: 'define_sub_total'},

                    /*{data: 'define_order_status', name: 'define_order_status'},*/
                   /* {data: 'action', name: 'action', orderable: false, searchable: false}*/
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

