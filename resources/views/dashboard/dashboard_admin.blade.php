@extends('layouts.master')
@section('content')
    <div style="padding: 12px;" class="pb-5">
        <div class="content-container" style="background: none">

            <a href="{{ route('dashboard') }}" class="dash-title" data-bs-toggle="tooltip"
                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a>

            <div class="info-card-container">

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ $customer_total }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('supplier.index') }}" class="link">
                                <b>Total Customer</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #E2EAFF;;">
                        <img src="{{ asset('images/aicon/distributor (1) 1.svg') }}" alt="">
                    </div>
                </div>

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ $supplier_total }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('supplier.index') }}" class="link">
                                <b>Total Supplier</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #D8F9F9;">
                        <img src="{{ asset('images/aicon/supplier (1) 1.svg') }}" alt="">
                    </div>
                </div>

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ $product_total }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('product.index') }}" class="link">
                                <b>Total Product</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #FCF4DA;">
                        <img src="{{ asset('images/aicon/ready-stock 1.svg') }}" alt="">
                    </div>
                </div>

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ number_format($sale_total, 2) }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('sale.index') }}" class="link">
                                <b>Total Sale</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #D7F9E9;">
                        <img src="{{ asset('images/aicon/cost (1) 1.svg') }}" alt="">
                    </div>
                </div>

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ number_format($purchase_total, 2) }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('purchase.index') }}" class="link">
                                <b>Total Purchase</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #F3D6FA;">
                        <img src="{{ asset('images/aicon/payment (1) 1.svg') }}" alt="">
                    </div>
                </div>

                <div class="info-card">
                    <div class="div">
                        <h3 class="mb-2">{{ number_format($expense_total, 2) }}</h3>
                        <p class="mb-0">
                            <a href="{{ route('expense.index') }}" class="link">
                                <b>Total Expense</b>
                            </a>
                        </p>
                    </div>
                    <div class="info-img" style="background: #F4FFEF;">
                        <img src="{{ asset('images/aicon/invoice (1) 1.svg') }}" alt="">
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex flex-direction" style="gap: 22px">
          <div class="chart-section">
            <div class="chart-header flex-direction">
                <div>
                    <p>Sales This Year</p>
                    <h2>$ 11,900,204</h2>
                </div>
                <div class="d-flex gap-3">
                    <input class="form-control" type="date" required="">
                    <input class="form-control" type="date" required="">
                    <button><img src="{{ asset('images/icon/filter-search.svg') }}" alt=""></button>
                    <button style="background: #6DBDFA;"><img src="{{ asset('images/icon/refresh.svg') }}" alt=""></button>
                </div>
            </div>
            <div id="chartContainer" style=" width: 100%;"></div>
          </div>
          <div class="pie-chart">
            <div class="mb-4">
                <p>Sales This Year</p>
                <h2>$ 11,900,204</h2>
            </div>
            <div style="display: flex;justify-content: center;align-items: center;">
                <canvas id="myChart" style=""></canvas>
            </div>
          </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('frontend.profile.scripts.update-profile-script');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        var xValues = ["This Year", "This Month"];
        var yValues = [30,70];
        var barColors = [
          "#6DBDFA",
          "#0CE0A3"

        ];

        new Chart("myChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {

          }
        });
        </script>

    <script>
        window.onload = function() {
            var options = {
                animationEnabled: true,
                theme: "light",
                title: {

                },
                axisY: {
                    includeZero: false,
                    interval: 500,
                    prefix: "",
                    // interlacedColor: "blue",
                    gridColor: " #E7E7E7",
                    risingColor: "#F79B8E",
                    labelFontColor: "#A2A2A9",
                    labelFontSize: "12"
                },
                toolTip: {
                    shared: false
                },
                legend: {
                    fontSize: 0
                },
                axisX: {
                    includeZero: false,
                    valueFormatString: "DD MMM",
                    interval: 4,
                    labelFontColor: "#A2A2A9",
                    labelFontSize: "12"
                },
                data: [{
                    type: "splineArea",
                    lineThickness: 2,
                    showInLegend: true,
                    yValueFormatString: "#,##0",
                    xValueFormatString: "DD MMMM",
                    color: "#abe1fa",
                    lineColor: "#7492FF",
                    markerSize: 10,
                    markerColor: "#7492FF",
                    borderColor: "rgba(0,0,0,0.1)",
                    risingColor: "#F79B8E",
                    dataPoints: [{
                            x: new Date(2022, 2, 10),
                            y: 500
                        },
                        {
                            x: new Date(2022, 2, 12),
                            y: 2500
                        },
                        {
                            x: new Date(2022, 2, 14),
                            y: 1800
                        },
                        {
                            x: new Date(2022, 2, 15),
                            y: 3000
                        },
                        {
                            x: new Date(2022, 2, 16),
                            y: 3300
                        },
                        {
                            x: new Date(2022, 2, 17),
                            y: 3000
                        },
                        {
                            x: new Date(2022, 2, 18),
                            y: 3500
                        },
                        {
                            x: new Date(2022, 2, 20),
                            y: 2000
                        },
                        {
                            x: new Date(2022, 2, 22),
                            y: 1500
                        },
                        {
                            x: new Date(2022, 2, 24),
                            y: 2800
                        },
                        {
                            x: new Date(2022, 2, 26),
                            y: 3500
                        },
                        {
                            x: new Date(2022, 2, 28),
                            y: 1300
                        },
                        {
                            x: new Date(2022, 2, 29),
                            y: 1600
                        },
                        {
                            x: new Date(2022, 2, 30),
                            y: 2500
                        },
                        {
                            x: new Date(2022, 2, 31),
                            y: 500
                        }
                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

        }
    </script>
    {{-- <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script> --}}
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endpush
