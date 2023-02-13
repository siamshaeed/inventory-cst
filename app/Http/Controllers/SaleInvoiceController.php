<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDue;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($sale_id)
    {
        return 'invoice details : view = '.$sale_id;
    }*/

    public function show($sale_id, Purchase $purchase)
    {
        $sale = Sale::find($sale_id);
        if (is_null($sale)) {
            notify()->warning("Whoops! Something Went Wrong.", "warning");
            return back();
        }

        $order          = Order::with(['user', 'supplier'])->find($sale->order_id);
        $order_items    = OrderItem::with(['product'])->where('order_id', $sale->order_id)->orderByDesc('id')->get();
        $sale_items     = SaleItem::where('sale_id', $sale_id)->get();
        $sale_payments  = SalePayment::whereSaleId($sale_id)->get();

        return view('sale.show_sale_invoice', compact('sale', 'order', 'order_items', 'sale_items', 'sale_payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
