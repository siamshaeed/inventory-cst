<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleItemList;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class SaleReportController extends Controller
{

    // Sale Customer Report
    public function customer(Request $request)
    {
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $sales = [];
        if(($start_date && $end_date) || $all_date){


            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $sales = Sale::with(['order', 'sale_items'])
                ->where(function($q) use ($start, $end) {
                    if ($start && $end) {
                        $q->whereBetween('date', [$start." 00:00:00", $end." 23:59:59"]);
                    }
                })
                ->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.sale.pdf_download_customer', compact('sales', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('sale_customer_report_'.$current_date.'.pdf');
        }

        return view('report.sale.customer',  compact(['sales', 'start_date', 'end_date', 'all_date']));
    }

    public function customerSlug(Request $request, $slug)
    {
        // Supplier Information
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $supplier       = Supplier::with(['market_type'])->whereSlug($slug)->firstOrFail();
        $supplier_id    = $supplier->id;

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $sales = [];
        if(($start_date && $end_date) || $all_date || $slug){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $sales = Sale::with(['order', 'sale_items'])
                ->whereHas('order', function ($q) use ($supplier_id) {
                    $q->where('supplier_id', $supplier_id);
                })
                ->where(function ($q) use ($start, $end) {
                    if ($start && $end) {
                        $q->whereBetween('date', [$start, $end]);
                    }
                })
                ->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.sale.pdf_download_customer_slug', compact('sales', 'start_date', 'end_date', 'supplier', 'all_date', 'slug'));
            return $pdf->download('sale_customer_details_report_'.$current_date.'.pdf');
        }

        return view('report.sale.customer_slug',  compact(['sales', 'start_date', 'end_date', 'supplier', 'slug', 'all_date']));
    }

    // Sale Single Product Report
    public function profitLoss(Request $request)
    {

        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $sale_item_lists = [];
        if(($start_date && $end_date) || $all_date){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $sale_item_lists = SaleItemList::with(
                ['sale' => function ($q) use ($start, $end){
                    if ($start && $end) {
                        $q->whereBetween('date', [$start, $end]);
                    }},
                    'sale_item', 'purchase_item'
                ]
            )->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.sale.pdf_download_profit_loss', compact('sale_item_lists', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('sale_profit_loss_'.$current_date.'.pdf');
        }

        return view('report.sale.profit_loss',  compact(['sale_item_lists', 'start_date', 'end_date', 'all_date']));
    }
}
