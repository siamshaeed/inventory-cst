@extends('layouts.master')

@section('content')

    <div class="mt-3">

        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip"
                           title="{{ __('Purchase Payments ') }}">{{ __('Purchase Due Payment') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('purchase-due.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       title="View Product"><i class="fa fa-home"></i> Purchase Payment</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">

                <form class="mt-4" action="{{ route('purchase-due.update', $purchase_info->id) }}" method="post">

                    @csrf

                    @method('put')

                    <div class="col-md-8">

                        <div class="mb-3 row d-none">
                            <label for="name" class="col-sm-4 col-form-label text-end"><b></b></label>
                            <div class="col-sm-6">

                                <div class="mb-3 row">
                                    <dt class="col-sm-3 text-end">Total Amount :</dt>
                                    <dd class="col-sm-9">{{ $purchase_info->total_amount }}</dd>

                                    <dt class="col-sm-3 text-end">Total Pay :</dt>
                                    <dd class="col-sm-9">{{ $purchase_info->total_pay }}</dd>

                                    <dt class="col-sm-3 text-end">Total Due :</dt>
                                    <dd class="col-sm-9">{{ $purchase_info->total_due }}</dd>
                                </div>

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label text-end"><b>Date :</b></label>
                            <div class="col-sm-6">
                                <input type="date"
                                       name="date"
                                       class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label text-end"><b>Remaining Amount :</b></label>
                            <div class="col-sm-6">
                                <input type="number"
                                       name="remain_amount"
                                       min="1"
                                       step="any"
                                       class="form-control remain_amount"
                                       placeholder="0.00"
                                       value="{{ $purchase_info->total_due }}"
                                       required readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label text-end"><b>Pay Amount :</b></label>
                            <div class="col-sm-6">
                                <input type="number"
                                       name="pay_amount"
                                       min="1"
                                       step="any"
                                       class="form-control pay_amount"
                                       placeholder="0.00"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-4 col-form-label text-end"><b>Due Amount :</b></label>
                            <div class="col-sm-6">
                                <input type="number"
                                       name="due_amount"
                                       min="1"
                                       step="any"
                                       class="form-control due_amount"
                                       placeholder="0.00"
                                       required readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="submit" class="col-sm-4 col-form-label text-end"></label>
                            <div class="col-sm-6">
                                <button class="btn btn-secondary btn-submit col-sm-3">Save</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>



@endsection

@push('scripts')


    <script type="text/javascript">


        $(".pay_amount").on('keyup', function () {

            let remain_amount = $('.remain_amount').val(),
                pay_amount = $(this).val(),
                due_amount = 0.00;

            due_amount = parseFloat(remain_amount) - parseFloat(pay_amount);

            $('.due_amount').val(due_amount.toFixed(2));

        });


    </script>


@endpush
