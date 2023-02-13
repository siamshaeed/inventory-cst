<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $orders = Order::with(['supplier'])->orderByDesc('id')->get();
        if ($request->ajax()) {
            $orders = Order::with(['supplier'])->orderByDesc('id')->get();
            return Datatables::of($orders)
                ->addIndexColumn()

                ->addColumn('define_order_number', function ($row) {
                    $id             = $row->id;
                    $order_id       = $row->id;
                    $order_number   = $row->order_number;
                    return view('order.field_order_number', compact(['id', 'order_id', 'order_number']));
                })
                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('order.field_date', compact(['date']));
                })
                ->addColumn('define_order_supplier_name', function ($row) {
                    $supplier_name = $row->supplier->name;
                    return view('order.field_supplier_name', compact(['supplier_name']));
                })
                ->addColumn('define_total_amount', function ($row) {
                    $id             = $row->id;
                    $total_amount   = $row->total_amount;
                    return view('order.field_total_amount', compact(['id', 'total_amount']));
                })

                ->addColumn('define_order_status', function ($row) {
                    $order = $row;
                    return view('order.common_field_order_status', compact(['order']));
                })

                /*->addColumn('action_edit_button', function ($row) {
                    return view('order.action_edit_button', compact(['row']));
                })*/

                ->addColumn('define_order_sale', function ($row) {
                    $order_id       = $row->id;
                    $sale_status    = $row->sale_status;
                    return view('order.action_order_for_sale_button', compact(['order_id', 'sale_status']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'order';
                    $details                = false;
                    $tbl_name               = 'orders';
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

        return view('order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ///$purchase_items = Item::with(['product'])->get();

        $products   = Product::with(['good'])->whereStatus(true)->get();
        $brands     = Brand::whereStatus(true)->get();
        $suppliers  = Supplier::with(['market_type'])->whereStatus(true)->get();

        return view('order.create', compact(['products', 'brands', 'suppliers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'date'          => 'required|date',
            'order_number'  => 'required|min:2|max:50|unique:orders,order_number',
            'supplier_id'   => 'required',
            'order_status'  => 'required',

            'product_id'    => 'required',
            'quantity'      => 'required',
            'unit_price'    => 'required',
            'discount'      => 'required',
            'sub_total'     => 'required',
        ]);

        // Purchase info
        $date           = $request->date;
        $order_number   = $request->order_number;
        $supplier_id    = $request->supplier_id;
        $order_status   = $request->order_status;

        // Order Items info
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $unit_price = $request->unit_price;
        $discount   = $request->discount;
        $sub_total  = $request->sub_total;

        // Grand total price
        $grand_total    = $request->grand_total;
        $total_discount = $request->total_discount;
        $total_amount   = $request->total_amount;

        //$payment_status = $this->paymentStatus($total_amount, $total_pay, $total_due);
        //$due_status     = $this->dueStatus($total_amount, $total_pay);
        //dd($request->all());

        DB::beginTransaction();
        try {
            // Insert order table
            $order = new Order();
            $order->user_id         = auth()->user()->id;
            $order->supplier_id     = $supplier_id;
            $order->date            = $date;
            $order->order_number    = $order_number;
            $order->grand_total     = $grand_total;
            $order->total_discount  = $total_discount;
            $order->total_amount    = $total_amount;
            $order->order_status    = $order_status;
            $order->save();

            // Insert items table
            foreach ($product_id as $key=>$value) {
                $item = new OrderItem();
                $item->user_id      = auth()->user()->id;
                $item->order_id     = $order->id;
                $item->product_id   = $product_id[$key];
                $item->date         = $date;
                $item->quantity     = $quantity[$key];
                $item->unit_price   = $unit_price[$key];
                $item->discount     = $discount[$key];
                $item->sub_total    = $sub_total[$key];
                $item->item_status  = 1;    // 1=Request
                $item->save();
            }
            DB::commit();

            notify()->success('Order Items Created Successful', 'Success');
            return redirect()->route('order.index');

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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_items = OrderItem::with(['product'])->whereOrderId($order->id)->get();
        return view('order.show', compact(['order', 'order_items']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $suppliers = Supplier::with(['market_type'])->whereStatus(true)->get();
        return view('order.edit', compact(['order', 'suppliers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'date'          => 'required|date',
            'order_number'  => 'required|min:2|max:50|unique:orders,order_number,'.$order->id,
            'supplier_id'   => 'required',
            'discount'      => 'numeric|min:0',
            'order_status'  => 'required',
        ]);

        // Purchase info
        $date           = $request->date;
        $order_number   = $request->order_number;
        $supplier_id    = $request->supplier_id;
        $discount       = $request->discount;
        $order_status   = $request->order_status;

        DB::beginTransaction();
        try {
            // Insert order table
            $order->user_id         = auth()->user()->id;
            $order->supplier_id     = $supplier_id;
            $order->date            = $date;
            $order->order_number    = $order_number;
            $order->total_discount  = $discount;
            $order->total_amount    = $order->grand_total - $discount;
            $order->order_status    = $order_status;
            $order->save();

            DB::commit();

            notify()->success('Order Information Updated Successful', 'Success');
            return redirect()->route('order.index');

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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
