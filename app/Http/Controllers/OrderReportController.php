<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PDF;

class OrderReportController extends Controller
{
    public function customer(Request $request)
    {
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
        $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

        $orders = [];
        if(($start_date && $end_date) || $all_date){
            $orders = Order::with(['supplier'])->orderBy('date', 'asc')
                ->where(function ($q) use ($start, $end){
                    if ($start && $end){
                        $q->whereBetween('date', [$start, $end]);
                    }
                })->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.order.pdf_download_order_customer', compact('orders', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('sale_customer_details_report_'.$current_date.'.pdf');
        }

        return view('report.order.index',  compact(['orders', 'start_date', 'end_date', 'all_date']));
    }
}
