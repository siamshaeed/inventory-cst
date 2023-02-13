<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ServiceRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // Total Customer
        $supplier       = Supplier::all();
        $customer_total = $supplier->where('market_type_id', 5)->count();
        $supplier_total = $supplier->whereNotIn('market_type_id', 5)->count();
        $product_total  = Product::all()->count();
        $sale_total     = Sale::sum('total_amount');
        $purchase_total = Purchase::sum('total_amount');
        $expense_total  = Expense::sum('amount');

        return view('dashboard.dashboard', compact([
            'customer_total', 'supplier_total', 'product_total', 'sale_total', 'purchase_total', 'expense_total'
        ]));
    }

    //
    public function index()
    {
        $service_request_count = ServiceRequest::where('workshop_id', auth()->user()->workshop->id)->count();

        return view('dashboard.index', compact('service_request_count'));
    }

    public function demoDashboard()
    {
        return view('dashboard.demo');

    }

}
