<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\OrderItemPaymentCalculationTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderItemController extends Controller
{
    use OrderItemPaymentCalculationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index order items';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Nothing to Crated';
    }

    public function createOrderItem($order_id)
    {
        $products   = Product::with(['good'])->whereStatus(true)->get();
        return view('order_item.create', compact(['order_id', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'order_id'      => 'required',
            'product_id'    => 'required',
            'date'          => 'required',
            'quantity'      => 'required|numeric',
            'unit_price'    => 'required',
            'discount'      => 'numeric|min:0',
            'sub_total'     => 'required',
            'item_status'   => 'required',
        ]);

        $order_id = $request->order_id;


        DB::beginTransaction();
        try {
            // Insert order table
            $order_item = new OrderItem();
            $order_item->user_id     = auth()->user()->id;
            $order_item->order_id    = $order_id;
            $order_item->product_id  = $request->product_id;
            $order_item->date        = $request->date;
            $order_item->quantity    = $request->quantity;
            $order_item->unit_price  = $request->unit_price;
            $order_item->discount    = $request->discount;
            $order_item->sub_total   = $request->sub_total;
            $order_item->item_status = $request->item_status;
            $order_item->save();

            // Calculate into 'order_items' and 'orders'
            $this->paymentCalculation($order_id);

            DB::commit();

            notify()->success('Order Items Saved Successful', 'Success');
            return redirect()->back();

        } catch(QueryException $exception){
            DB::rollBack();
            //return $exception->getMessage();
            notify()->warning($exception->getMessage(), "Error");
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $order_id)
    {
        //return $order_items = OrderItem::with(['product'])->where('order_id', $order_id)->orderByDesc('id')->get();
        if ($request->ajax()) {
            $order_items = OrderItem::with(['product'])->where('order_id', $order_id)->orderByDesc('id')->get();
            return Datatables::of($order_items)
                ->addIndexColumn()

                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('order_item.field_date', compact(['date']));
                })

                ->addColumn('define_product_name', function ($row) {
                    $id             = $row->id;
                    $product_name   = $row->product->good->name;
                    return view('order_item.field_product_name', compact(['id', 'product_name']));
                })
                ->addColumn('define_sub_total', function ($row) {
                    $id         = $row->id;
                    $sub_total  = $row->sub_total;
                    return view('order_item.field_sub_total', compact(['id', 'sub_total']));
                })

                ->addColumn('define_order_status', function ($row) {
                    $order_item = $row;
                    return view('order_item.common_field_item_status', compact(['order_item']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'order-item';
                    $details                = false;
                    $tbl_name               = 'order_items';
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

        $order = Order::with(['supplier'])->find($order_id);
        return view('order_item.index', compact(['order_id', 'order']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //return $orderItem;
        $products   = Product::with(['good'])->whereStatus(true)->get();
        return view('order_item.edit', compact(['orderItem', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderItemRequest  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //dd($request->all());
        $request->validate([
            //'order_id'      => 'required',
            //'product_id'    => 'required',
            'date'          => 'required',
            'quantity'      => 'required|numeric',
            'unit_price'    => 'required',
            'discount'      => 'numeric|min:0',
            'sub_total'     => 'required',
            'item_status'   => 'required',
        ]);

        $order_id = $orderItem->order_id;


        DB::beginTransaction();
        try {
            $orderItem->date        = $request->date;
            $orderItem->quantity    = $request->quantity;
            $orderItem->unit_price  = $request->unit_price;
            $orderItem->discount    = $request->discount;
            $orderItem->sub_total   = $request->sub_total;
            $orderItem->item_status = $request->item_status;
            $orderItem->save();

            // Calculate into 'order_items' and 'orders'
            $this->paymentCalculation($order_id);

            DB::commit();

            notify()->success('Order Items Updated Successful', 'Success');
            return redirect()->back();

        } catch(QueryException $exception){
            DB::rollBack();
            //return $exception->getMessage();
            notify()->warning($exception->getMessage(), "Error");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
