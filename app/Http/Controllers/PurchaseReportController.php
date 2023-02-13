<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PurchaseReportController extends Controller
{
    // Purchase Customer Report
    public function customer(Request $request)
    {
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $purchases = [];
        if(($start_date && $end_date) || $all_date){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $purchases = Purchase::with(['supplier'])
                ->orderBy('date', 'asc')
                ->where(function ($q) use ($start, $end){
                    if ($start && $end){
                        $q->whereBetween('date', [$start, $end]);
                    }
                })
                ->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.purchase.pdf_download_purchase_customer', compact('purchases', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('purchase_customer_report_'.$current_date.'.pdf');
        }

        return view('report.purchase.customer', compact(['purchases', 'start_date', 'end_date', 'all_date']));
    }

    // Purchase Customer Slug Details
    public function customerSlug(Request $request, $slug)
    {
        // Supplier Information
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $supplier = Supplier::with(['market_type'])->whereSlug($slug)->firstOrFail();

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $purchases = [];
        if(($start_date && $end_date) || $all_date || $slug){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $purchases = Purchase::with(['supplier'])
                ->whereSupplierId($supplier->id)
                ->orderBy('date', 'asc')
                ->where(function ($q) use ($start, $end){
                    if ($start && $end){
                        $q->whereBetween('date', [$start, $end]);
                    }
                })
                ->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.purchase.pdf_download_purchase_customer_slug', compact('purchases', 'start_date', 'end_date', 'supplier', 'all_date'));
            return $pdf->download('purchase_customer_details_report_'.$current_date.'.pdf');
        }

        return view('report.purchase.customer_slug', compact(['purchases', 'start_date', 'end_date', 'supplier', 'all_date']));
    }

    // Purchase SingleProduct Report
    public function singleProduct(Request $request)
    {
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $purchase_items = [];
        if(($start_date && $end_date) || $all_date){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $purchase_items = PurchaseItem::with(['purchase', 'product'])
                ->orWhereHas('purchase', function ($q) use ($start, $end) {
                    if ($start && $end){
                        $q->whereBetween('date', [$start, $end]);
                    }
                })
                ->get();
        }

        // Pdf Download
        if (isset($request->pdf)) {
            $current_date = Carbon::now()->format('d-m-y_g:i_A');
            $pdf = PDF::loadView('report.purchase.pdf_download_single_product', compact('purchase_items', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('purchase_single_product_report_'.$current_date.'.pdf');
        }

        return view('report.purchase.single_product',  compact(['purchase_items', 'start_date', 'end_date', 'all_date']));
    }
}
