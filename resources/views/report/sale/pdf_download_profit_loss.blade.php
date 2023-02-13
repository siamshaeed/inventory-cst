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
        margin-top:0px;">Sale Profit Loss</p>

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
        margin-bottom: 25px;">List of the all profit & loss data</p>
        @endif
</div>

<div>
    <table id="report-table">
        <tr>
            <th>{{ __("SL") }}</th>
            <th style="width: 58px;">{{ __("Date") }}</th>
            <th>{{ __("Product Name") }}</th>

            <th>{{ __("Quantity") }}</th>
            <th>{{ __("Unit Price") }}</th>
            <th>{{ __("Sub Total") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Grand Total") }}</th>

            <th>{{ __("Buy Price") }}</th>
            <th>{{ __("Sale Price") }}</th>
            <th>{{ __("Profit or Loss") }}</th>
        </tr>
        @php $total_buy_count = 0; $total_sale_count = 0; @endphp
        @forelse($sale_item_lists as $list)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $list->sale_item->date }}</td>
                <td>
                    {{ $list->sale_item->product->good->name }}
                </td>

                <td>{{ $list->qty }}</td>
                <td>{{ $list->sale_item->unit_price }}</td>
                <td>
                    @php
                        $sub_total = $list->qty * $list->sale_item->unit_price;
                    @endphp
                    {{ $sub_total }}
                </td>
                <td>
                    @php
                        $discount           = number_format($list->sale_item->discount / $list->sale_item->qty, 2) * $list->qty;
                        $average_discount   = number_format($list->sale_item->average_discount / $list->sale_item->qty, 2) * $list->qty;
                        $total_discount     = $discount + $average_discount;
                    @endphp
                    {{--{{ $discount }} + {{ $average_discount }} <br> =--}}
                    {{ $total_discount }}
                </td>
                <td>
                    @php
                        $grand_total = $sub_total - $total_discount;
                        $total_sale_count += $grand_total;
                    @endphp
                    {{ $grand_total }}
                </td>

                <td>
                    @php
                        $buy_unit_price = $list->purchase_item->unit_price;
                        $total_buy_price = $buy_unit_price * $list->qty;
                        $total_buy_count += $total_buy_price;
                    @endphp
                    {{ $total_buy_price }}
                </td>
                <td>{{ $grand_total }}</td>
                <td>
                    @php
                        $loss_and_profit = $grand_total - $total_buy_price;
                    @endphp

                    @if($loss_and_profit < 0)
                        <span class="text-warning">{{ $loss_and_profit }}</span>
                    @else
                        <span class="text-success">{{ $loss_and_profit }}</span>
                    @endif
                </td>
            </tr>
        @empty
        <tr>
            <td colspan="11"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
          </tr>
        @endforelse

        <tr>
            <th colspan="7"><b>Summary</b></th>
            <th><b>{{ $total_sale_count }}</b></th>
            <th><b>{{ $total_buy_count }}</b></th>
            <th><b>{{ $total_sale_count }}</b></th>
            <th><b>{{ $total_sale_count - $total_buy_count }}</b></th>
        </tr>
    </table>
</div>

</body>
</html>

