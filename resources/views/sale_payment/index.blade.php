@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('sale-payment.index') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Sale View') }}">
                            {{ __('Sale Payment') }}
                        </a>
                        <br>
                        Order Number: <b class="text-primary">{{ $sale->order->order_number }}</b>; OrderName: <b class="text-success">{{ $sale->order->supplier->name }}</b>
                        <br>
                        Amount: <b class="text-warning">{{ $sale->total_amount }}</b>; &nbsp;&nbsp;
                        Paid: <b class="text-success">{{ $sale->total_pay }}</b>; &nbsp;&nbsp;
                        Due: <b class="text-danger">{{ $sale->total_due }}</b>
                    </p>
                </div>
                <div class="head-right d-flex">
                    @if($sale->payment_status == 3 )
                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="Payment is Paid" style="height: 33px">
                            Payment is Paid
                        </button>
                    @else
                        <a href="{{route('sale-payment.edit', $sale->id)}}" class="btn btn-sm btn-secondary text-white" data-toggle="tooltip" title="Pay Due Payment" style="height: 33px">
                            <i class="fa fa-plus"></i> Due Payment
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-body pb-5">
                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Order Crated Date">{{ __("Created Date") }}</th>

                            <th scope="col">{{ __("Amount") }}</th>
                            <th scope="col">{{ __("Pay") }}</th>
                            <th scope="col">{{ __("Due") }}</th>

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
                ajax: '{{ route("sale-payment.show", $sale_id) }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_date', name: 'define_date'},

                    {data: 'amount', name: 'amount'},
                    {data: 'pay', name: 'pay'},
                    {data: 'due', name: 'due'},

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

