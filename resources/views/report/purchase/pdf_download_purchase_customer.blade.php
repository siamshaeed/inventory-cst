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
    margin-top:0px;">Purchase Customer Report</p>
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
       margin-bottom: 25px;"> List of the all purchase customer data</p>
    @endif
</div>

<div>
    <table id="report-table">
        <tr>
            <th>{{ __("SL") }}</th>
            <th>{{ __("Buying Date") }}</th>
            <th>{{ __("Supplier Name") }}</th>
            <th>{{ __("Invoice") }}</th>
            <th>{{ __("Purchase Status") }}</th>
            <th>{{ __("Grand Amount") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Total") }}</th>
            <th>{{ __("Paid") }}</th>
            <th>{{ __("Due") }}</th>
        </tr>

        @forelse($purchases as $purchase)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $purchase->date}}</td>
                <td>
                    {{ $purchase->supplier->name }}
                </td>
                <td>{{ $purchase->invoice_number }}</td>
                <td>
                    @if($purchase->isOrdered())
                        <span class="badge bg-warning">Ordered</span>
                    @elseif($purchase->isPending())
                        <span class="badge bg-danger">Pending</span>
                    @elseif($purchase->isReceived())
                        <span class="badge bg-success">Received</span>
                    @endif
                </td>
                <td>{{ $purchase->grand_amount }}</td>
                <td>{{ $purchase->total_discount }}</td>
                <td>
                    {{ $purchase->total_amount }}
                </td>
                <td>{{ $purchase->total_pay }}</td>
                <td>{{ $purchase->total_due }}</td>
            </tr>
        @empty
           <tr>
             <td colspan="10"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
           </tr>
        @endforelse

        @if(!empty($purchases))
            <tr>
                <th colspan="5">
                    {{ __("Total ") }}
                </th>
                <th>
                    <b>{{ $purchases->sum('grand_amount') }}</b>
                </th>
                <th>
                    <b>{{ $purchases->sum('total_discount') }}</b>
                </th>
                <th>
                    <b>{{ $purchases->sum('total_amount') }}</b>
                </th>
                <th>
                    <b>{{ $purchases->sum('total_pay') }}</b>
                </th>
                <th>
                    <b>{{ $purchases->sum('total_due') }}</b>
                </th>
            </tr>
        @endif
    </table>
</div>

</body>
</html>

