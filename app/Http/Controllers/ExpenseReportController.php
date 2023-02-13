<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ExpenseReportController extends Controller
{
    // Expense Report
    public function expense(Request $request)
    {
        $request->validate([
            'start_date'    => 'date',
            'end_date'      => 'date',
        ]);

        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $all_date   = $request->date;

        $expenses = [];
        if(($start_date && $end_date) || $all_date){

            $start  = (!is_null($all_date)) ? null : Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00";
            $end    = (!is_null($all_date)) ? null : Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";

            $expenses = Expense::with('category')
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
            $pdf = PDF::loadView('report.expense.pdf_download_expense_all', compact('expenses', 'start_date', 'end_date', 'all_date'));
            return $pdf->download('expense_report_'.$current_date.'.pdf');
        }

        return view('report.expense.index',  compact(['expenses', 'start_date', 'end_date', 'all_date']));
    }

}
