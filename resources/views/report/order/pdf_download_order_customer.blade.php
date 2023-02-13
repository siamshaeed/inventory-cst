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
        margin-top:0px;">Order Customer Report</p>

        @if($start_date && $end_date)
        <p style="font-weight: 500;
        font-size: 20px;
        line-height: 30px;
        color: #9399A0;
        margin-top: 2px;
        margin-bottom: 25px;">From &nbsp; <span style="color: #6A6352">{{ $start_date }}</span> &nbsp; To &nbsp; <span style="color: #6A6352">{{ $end_date }}</span></p>
        @endif

        @if($all_date)
        <p style="font-weight: 500;
        font-size: 20px;
        line-height: 30px;
        color: #9399A0;
        margin-top: 2px;
        margin-bottom: 25px;"> List of the all Order customer data</p>
        @endif
    </div>
 <div>
    <table id="report-table">
        <tr>
            <th>{{ __("SL") }}</th>
            <th>{{ __("Created") }}</th>
            <th>{{ __("Order Number") }}</th>
            <th>{{ __("Order Name") }}</th>
            <th>{{ __("Grand Total") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Total") }}</th>
        </tr>

        @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->supplier->name }}</td>
                <td>{{ $order->	grand_total }}</td>
                <td>{{ $order->total_discount }}</td>
                <td>{{ $order->total_amount}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="7"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
          </tr>
        @endforelse

        @if(!empty($order))
            <tr>
                <th colspan="4">{{ __("Total ") }}</th>
                <th>
                    <b>{{ $order->sum('grand_total') }}</b>
                </th>
                <th>
                    <b>{{ $order->sum('total_discount') }}</b>
                </th>
                <th>
                    <b>{{ $order->sum('total_amount') }}</b>
                </th>
            </tr>
        @endif
    </table>
</div>

</body>
</html>

