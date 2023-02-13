<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Http\Requests\StorePurchaseItemRequest;
use App\Http\Requests\UpdatePurchaseItemRequest;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\isEmpty;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $items = PurchaseItem::with(['purchase', 'product'])->orderByDesc('id')->get();
        if ($request->ajax()) {
            $items = PurchaseItem::with(['purchase', 'product'])->orderByDesc('id')->get();
            return Datatables::of($items)
                ->addIndexColumn()

                //--Product Name
                ->addColumn('define_name', function ($row) {
                    $name   = $row->product->good->name;
                    $brand  = $row->product->brand->name;
                    return view('purchase_item.field_name', compact(['name', 'brand']));
                })

                ->addColumn('define_date', function ($row) {
                    $date = $row->purchase->date;
                    return view('purchase_item.field_date', compact(['date']));
                })

                ->addColumn('define_stock_in', function ($row) {
                    $stock_in = $row->quantity;
                    return view('purchase_item.field_stock_in', compact(['stock_in']));
                })
                ->addColumn('define_stock_available', function ($row) {
                    $stock_available = $row->stock_available;
                    return view('purchase_item.field_stock_available', compact(['stock_available']));
                })
                ->addColumn('define_stock_status', function ($row) {
                    $purchase_item = $row;
                    return view('purchase_item.common_field_stock_status', compact(['purchase_item']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('purchase_item.index');
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
     * @param  \App\Http\Requests\StorePurchaseItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $purchase_id)
    {
        // Check PurchaseItem Data
        $items = PurchaseItem::with(['purchase', 'product'])->wherePurchaseId($purchase_id)->orderByDesc('id')->get();
        if($items->isEmpty()){
            notify()->warning("Whoops! Something Went Wrong.", "Warning");
            return back();
        }

        if ($request->ajax()) {
            $items = PurchaseItem::with(['purchase', 'product'])->wherePurchaseId($purchase_id)->orderByDesc('id')->get();
            return Datatables::of($items)
                ->addIndexColumn()

                //--Product Name
                ->addColumn('define_name', function ($row) {
                    $name   = $row->product->good->name;
                    $brand  = $row->product->brand->name;
                    return view('purchase_item.field_name', compact(['name', 'brand']));
                })

                ->addColumn('define_date', function ($row) {
                    $date = $row->purchase->date;
                    return view('purchase_item.field_date', compact(['date']));
                })

                ->addColumn('define_stock_in', function ($row) {
                    $stock_in = $row->quantity;
                    return view('purchase_item.field_stock_in', compact(['stock_in']));
                })
                ->addColumn('define_stock_available', function ($row) {
                    $stock_available = $row->stock_available;
                    return view('purchase_item.field_stock_available', compact(['stock_available']));
                })
                ->addColumn('define_stock_status', function ($row) {
                    $purchase_item = $row;
                    return view('purchase_item.common_field_stock_status', compact(['purchase_item']));
                })
                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'purchase-item';
                    $details                = false;
                    $tbl_name               = 'purchase_items';
                    $tbl_foreign_id         = $row->purchase_id;
                    $tbl_foreign_tbl_name   = 'purchases';
                    $tbl_foreign_product_id = $row->product_id;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name', 'tbl_foreign_product_id']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('purchase_item.purchase_item_for_purchase', compact('purchase_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_id)
    {
        // Just Demo use this function

        /*$purchase = Purchase::findOrFail($purchase_id);

        $sale = Sale::whereId(1)->first();
        if ($sale->total_due < 0) {
            notify()->warning("No Due Amount Remain", "Error");
            return redirect()->back();
        }

        return view('purchase_item.edit_rough_file', compact(['sale']));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseItemRequest  $request
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseItemRequest $request, PurchaseItem $purchaseItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseItem $purchaseItem)
    {
        //
    }
}
