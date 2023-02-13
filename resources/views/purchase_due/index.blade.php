@extends('layouts.master')

@section('content')

    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">

                <div class="head-left d-flex">

                    <span></span>

                    <p class="mb-0 ms-1">

                        <a href="{{ route('purchase-due.index') }}"
                           class="link"
                           data-bs-toggle="tooltip"
                           title="{{ __('Purchase View') }}">
                            {{ __('Purchase History') }} -
                        </a>

                        Invoice: <b class="text-primary"> {{ $purchase->invoice_number }}</b>;&nbsp;&nbsp;
                        Supplier: <b class="text-success">{{ $purchase->supplier->name }}</b>; <br><br>
                        Amount: <b class="text-warning">{{ $purchase->total_amount }}</b>; &nbsp;&nbsp;
                        Paid: <b class="text-success">{{ $purchase->total_pay }}</b>; &nbsp;&nbsp;
                        Due: <b class="text-danger">{{ $purchase->total_due }}</b>
                    </p>

                </div>

                <div class="head-right d-flex">

                    @if($purchase->payment_status == 3 )

                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip"
                                title="Payment is Paid"
                                style="height: 32px;">
                            Payment is Paid
                        </button>

                    @else

                        <a href="{{route('purchase-due'.'.edit', $purchase_id)}}"
                           class="btn btn-sm btn-secondary text-white"
                           style="height: 32px;"
                           data-toggle="tooltip" title="Due Payment">
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
                            <th scope="col" data-toggle="tooltip" title="Purchase Date">{{ __("Date") }}</th>

                            <th scope="col" data-toggle="tooltip" title="Amount To Pay">{{ __("Amount") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Paid Amount">{{ __("Paid") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Due Amount">{{ __("Due") }}</th>

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

        $(document).ready(function () {

            $('#custom-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,
                ajax: '{{ route("purchase-due.show", $purchase_id) }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'define_date', name: 'define_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'pay', name: 'pay'},
                    {data: 'due', name: 'due'},

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


@push('scripts')

    <script type="text/javascript">


        $('.pay_amount').on('keyup', function () {

            let remain_amount = $('.remain_amount').val(),
                pay_amount = $(this).val(),
                due_amount = 0.00;

            due_amount = parseFloat(remain_amount) - parseFloat(pay_amount);

            $('.due_amount').val(due_amount.toFixed(2));

        });


    </script>


@endpush

