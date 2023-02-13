<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseExportController extends Controller
{
    //
    public function export()
    {
        return Excel::download(new ExpenseExport, 'expenses.xlsx');
    }
}
