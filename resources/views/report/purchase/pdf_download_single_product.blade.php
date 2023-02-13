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
    margin-top:0px;">Purchase Single Product Report</p>

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
    margin-bottom: 25px;">List of the all purchase single product data</p>
    @endif
</div>

<div>
    <table id="report-table">
        <tr>
            <th>{{ __("SL") }}</th>
            <th>{{ __("Buying Date") }}</th>
            <th>{{ __("Product Name") }}</th>

            <th>{{ __("Quantity") }}</th>
            <th>{{ __("Price") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Total") }}</th>

            <th>{{ __("Selling Price") }}</th>
            <th>{{ __("Qty Out") }}</th>
            <th>{{ __("Qty Available") }}</th>
        </tr>

        @forelse($purchase_items as $items)
            <tr class="rem-bold">
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $items->purchase->date }}
                </td>
                <td>
                    {{ $items->product->good->name}}
                </td>

                <td>{{ $items->quantity }}</td>
                <td>{{ $items->unit_price }}</td>
                <td>{{ $items->discount }}</td>
                <td>
                    {{ $items->sub_total }}
                </td>

                <td>
                    {{ $items->selling_price }}
                </td>
                <td>{{ $items->stock_out }}</td>
                <td>{{ $items->stock_available }}</td>
            </tr>
        @empty
        <tr>
            <td colspan="10"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
          </tr>
        @endforelse

        @if(!empty($purchase_items))
            <tr>
                <th colspan="6">
                    {{ __("Total ") }}
                </th>

                <th>
                    <b>{{ $purchase_items->sum('sub_total') }}</b>
                </th>
                <th>
                    <b>{{ $purchase_items->sum('selling_price') }}</b>
                </th>
                <th colspan="2"></th>
            </tr>
        @endif
    </table>
</div>

</body>
</html>

