<!DOCTYPE html>
<html>
<head>
    <style>
        #report-table {
            border-collapse: collapse;
            width: 100%;
        }

        #report-table td,
        #report-table th {
            border: 1px solid #282828;
            padding: 8px;
        }

        #report-table td {
            font-weight: 400;
            font-size: 14px;
            color: #2C3D53;
            padding: 12px 0px;
            text-align: center;
        }

        #report-table tr:nth-last-child(4) td {
            font-weight: 600;
            font-size: 16px;
        }
        #report-table tbody tr:nth-child(2) td{
            font-weight: 400 !important;
        }
        #report-table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.1em;
            border-top: 1px solid #282828;
            border-bottom: 1px solid #282828;
        }
    </style>
</head>
<body>
<div style="text-align: center; margin-bottom: 10px;">
    <p style="font-weight: 700;
        font-size: 24px;
        line-height: 36px;
        color: #2C3D53;
        margin-bottom: 0px;
        margin-top:0px;">Sale Customer Report</p>

    <b>{{ $supplier->name }}</b>
    {{ $supplier->phone }} <br>
    {{ $supplier->address }} <br>
    @if($start_date && $end_date)
    <p style="font-weight: 500;
    font-size: 20px;
    line-height: 30px;
    color: #9399A0;
    margin-top: 12px;
    margin-bottom: 20px;">From &nbsp; <span style="color: #6A6352">{{ $start_date }}</span> &nbsp; To &nbsp; <span style="color: #6A6352">{{ $end_date }}</span></p>
    @endif

    @if($all_date)
    <p style="font-weight: 500;
    font-size: 20px;
    line-height: 30px;
    color: #9399A0;
    margin-top: 12px;
    margin-bottom: 20px;">List of the all sale customer data</p>
    @endif
</div>

<div>
    <table id="report-table">
        <tr>
            <th>{{ __("SL") }}</th>
            <th>{{ __("Date") }}</th>
            <th>{{ __("Qty") }}</th>

            <th>{{ __("Total Price") }}</th>
            <th>{{ __("Total Discount") }}</th>
            <th>{{ __("Total Pre Due") }}</th>

            <th>{{ __("Grand Amount") }}</th>
            <th>{{ __("Pay") }}</th>
            <th>{{ __("Due") }}</th>
        </tr>

        @php $total_qty = 0; @endphp
        @forelse($sales as $sale)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sale->date }}</td>
                <td>
                    {{ $sale->sale_items->count() }}
                    @php $total_qty += $sale->sale_items->count() @endphp
                </td>

                <td>
                    {{ $sale->grand_amount }}
                </td>
                <td>{{ $sale->total_discount }}</td>
                <td>{{ $sale->total_pre_due }}</td>

                <td>
                    {{ $sale->total_amount }}
                </td>
                <td>{{ $sale->total_pay }}</td>
                <td>{{ $sale->total_due }}</td>
            </tr>
        @empty
        <tr>
            <td colspan="9"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
          </tr>
        @endforelse

        @if(!empty($sales))
            <tr>
                <th colspan="2"><b>Summary</b></th>
                <th>
                    <b>{{ $total_qty }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('grand_amount') }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('total_discount') }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('total_pre_due') }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('total_amount') }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('total_pay') }}</b>
                </th>
                <th>
                    <b>{{ $sales->sum('total_due') }}</b>
                </th>
            </tr>
        @endif
    </table>
</div>

</body>
</html>

