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
        #report-table tbody tr:nth-child(4) td{
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
        margin-top:0px;">Expense Report</p>

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
        margin-bottom: 25px;">List of the all expense data</p>
        @endif
</div>

<table id="report-table">
    <tr>
        <th>{{ __("SL") }}</th>
        <th>{{ __("Date") }}</th>
        <th>{{ __("Category") }}</th>
        <th>{{ __("Title") }}</th>
        <th>{{ __("Amount") }}</th>
    </tr>


    @forelse($expenses as $expense)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->category->name }}</td>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->amount }}</td>
        </tr>
    @empty
    <tr>
        <td colspan="5"><p style="padding: 6px 0px;color:#E2AD36;font-weight:600;font-size:18px">No Data Found !</p></td>
      </tr>
    @endforelse


    <tr>
        <th colspan="4">{{ __("Total") }}</th>
        {{--                            <th scope="col"  data-toggle="tooltip" >{{ $expenses->sum('amount') }}</th>--}}
        <th>
        @if(!empty($expenses))
            {{ number_format($expenses->sum('amount'), 2) }}
            @endif
        </th>
    </tr>

</table>

</body>
</html>

