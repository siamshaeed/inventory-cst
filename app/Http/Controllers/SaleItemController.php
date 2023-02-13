<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Http\Requests\StoreSaleItemRequest;
use App\Http\Requests\UpdateSaleItemRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Sale Item Panel';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Nothing to created';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $sale_id)
    {
        $sale = Sale::with(['order'])->find($sale_id);
        if (is_null($sale)) {
            notify()->warning("Whoops! Something Went Wrong.", "warning");
            return back();
        }

        //return $order_items = SaleItem::with(['sale', 'order_item', 'purchase_item'])->where('sale_id', $sale_id)->orderByDesc('id')->get();
        if ($request->ajax()) {
            $order_items = SaleItem::with(['sale', 'order_item', 'purchase_item'])->where('sale_id', $sale_id)->orderByDesc('id')->get();
            return Datatables::of($order_items)
                ->addIndexColumn()

                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('sale_item.field_date', compact(['date']));
                })

                ->addColumn('define_product_name', function ($row) {
                    $id             = $row->id;
                    $product_name   = $row->order_item->product->good->name;
                    return view('sale_item.field_product_name', compact(['id', 'product_name']));
                })
                ->addColumn('define_sub_total', function ($row) {
                    $id         = $row->id;
                    $sub_total  = $row->sub_total;
                    return view('sale_item.field_sub_total', compact(['id', 'sub_total']));
                })

                /*->addColumn('define_order_status', function ($row) {
                    return view('order_item.field_item_status', compact(['row']));
                })*/

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'sale-item';
                    $details                = false;
                    $tbl_name               = 'sale_items';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('sale_item.index', compact(['sale_id', 'sale']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleItem $saleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleItemRequest  $request
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleItemRequest $request, SaleItem $saleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
