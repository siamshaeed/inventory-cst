<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\SaleItem;
use App\Models\SaleItemList;
use App\Models\SalePayment;
use App\Models\Supplier;
use App\Traits\PurchasePaymentStatusTrait;
use App\Traits\SaleInsertUpdateTrait;
use App\Traits\StockAvailableTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{
    use PurchasePaymentStatusTrait;
    use SaleInsertUpdateTrait;
    use StockAvailableTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $sales = Sale::with(['order'])->orderByDesc('id')->get();
        if ($request->ajax()) {
            $sales = Sale::with(['order'])->orderByDesc('id')->get();
            return Datatables::of($sales)
                ->addIndexColumn()
                ->addColumn('define_order_number', function ($row) {
                    $order_id = $row->order_id;
                    $order_number = $row->order->order_number;
                    return view('sale.field_order_number', compact(['order_id', 'order_number']));
                })
                ->addColumn('define_date', function ($row) {
                    $sale_id = $row->id;
                    $date = $row->date;
                    return view('sale.field_date', compact(['sale_id', 'date']));
                })
                ->addColumn('define_grand_amount', function ($row) {
                    $sale_id = $row->id;
                    $grand_amount = $row->grand_amount;
                    return view('sale.field_grand_amount', compact(['sale_id', 'grand_amount']));
                })
                ->addColumn('define_total_amount', function ($row) {
                    $id = $row->id;
                    $total_amount = $row->total_amount;
                    return view('sale.field_total_amount', compact(['id', 'total_amount']));
                })
                ->addColumn('define_payment_status', function ($row) {
                    $sale = $row;
                    return view('sale.common_field_payment_status', compact(['sale']));
                })
                /*->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'sale';
                    $details                = false;
                    $tbl_name               = 'sales';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })*/

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Nothing To Created';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSaleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return 'show details';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSaleRequest $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function saleOrderCrate($order_id)
    {
        $order = Order::find($order_id);
        if (is_null($order)) {
            notify()->warning("Whoops!", "Something Went Wrong.");
            return redirect()->route('order.index');
        }
        // Check order sale_status
        if ($order->sale_status == true) {
            notify()->warning("Already Sale this Order.", "Whoops!");
            return redirect()->route('order.index');
        }

        $order_items = OrderItem::with(['product'])->whereOrderId($order_id)->get();

        $product = [];
        foreach ($order_items as $item) {
            //echo $item->product_id . '<br>';
            $product[$item->product_id] = $item->product_id;
        }

        // Stock Retrieve
        $purchase_items = PurchaseItem::with(['product', 'purchase'])->whereIn('product_id', $product)->get();

        return view('sale.create', compact(['order', 'order_items', 'purchase_items']));
    }

    public function saleOrderStore(StoreSaleRequest $storeSaleRequest, $order_id)
    {
        //dd($storeSaleRequest->all());
        $order_item_id  = $storeSaleRequest->order_item_id;
        $product_id     = $storeSaleRequest->product_id;
        $quantity       = $storeSaleRequest->quantity;
        $unit_price     = $storeSaleRequest->unit_price;
        $total_price    = $storeSaleRequest->total_price;
        $discount       = $storeSaleRequest->discount;
        $sub_total      = $storeSaleRequest->sub_total;

        $date           = $storeSaleRequest->date;
        $grand_amount   = $storeSaleRequest->grand_amount;
        $total_discount = $storeSaleRequest->total_discount;
        $total_pre_due  = $storeSaleRequest->total_pre_due;
        $total_amount   = $storeSaleRequest->total_amount;
        $total_pay      = $storeSaleRequest->total_pay;
        $total_due      = $storeSaleRequest->total_due;
        $average_discount   = number_format($total_discount/count($product_id), 2);


        // Check SubmitForm Validation for Stock Limit Value
        foreach ($product_id as $key => $value) {
            $order_item = OrderItem::with(['product'])->find($order_item_id[$key]);
            $product_name = $order_item->product->good->name;

            if ($quantity[$key] > $order_item->product->stock) {
                notify()->warning($product_name . ', ' . "is not available !", "Warning");
                return redirect()->back();
            } elseif ($quantity[$key] <= 0) {
                notify()->warning($product_name . ', ' . "You have to take at least one product", "Warning");
                return redirect()->back();
            }
        }


        DB::beginTransaction();
        try {

            // Insert 'sales' table
            $sale_insert = new Sale();
            $sale_insert->user_id           = Auth::user()->id;
            $sale_insert->order_id          = $order_id;
            $sale_insert->date              = $date;
            $sale_insert->grand_amount      = $grand_amount;
            $sale_insert->total_discount    = $total_discount;
            $sale_insert->total_pre_due     = $total_pre_due;
            $sale_insert->total_amount      = $total_amount;
            $sale_insert->total_pay         = $total_pay;
            $sale_insert->total_due         = $total_due;
            $sale_insert->payment_status    = $this->paymentStatus($total_amount, $total_pay, $total_due);
            $sale_insert->save();

            // Insert 'sale_payments' table
            $sale_payment_insert = new SalePayment();
            $sale_payment_insert->user_id   = Auth::user()->id;
            $sale_payment_insert->sale_id   = $sale_insert->id;
            $sale_payment_insert->date      = $date;
            $sale_payment_insert->amount    = $total_amount;
            $sale_payment_insert->pay       = $total_pay;
            $sale_payment_insert->due       = $total_due;
            $sale_payment_insert->status    = $this->dueStatus($total_amount, $total_pay);
            $sale_payment_insert->save();

            // Update 'orders' table
            $order_update = Order::find($order_id);
            $order_update->total_pre_due = $total_pre_due;
            $order_update->save();


            // Calculation
            foreach ($product_id as $key => $value) {
                $need_qty = $quantity[$key];

                // Insert 'sale_items' table
                $sale_item_insert = new SaleItem();
                $sale_item_insert->user_id          = Auth::user()->id;
                $sale_item_insert->sale_id          = $sale_insert->id;
                $sale_item_insert->order_item_id    = $order_item_id[$key];
                $sale_item_insert->product_id       = $product_id[$key];
                $sale_item_insert->date             = $date;
                $sale_item_insert->qty              = $quantity[$key];
                $sale_item_insert->unit_price       = $unit_price[$key];
                $sale_item_insert->total_price      = $total_price[$key];
                $sale_item_insert->discount         = $discount[$key];
                $sale_item_insert->average_discount = $average_discount;
                $sale_item_insert->sub_total        = $sub_total[$key];
                $sale_item_insert->save();

                // Retrieve 'purchase_items' table
                $purchaseItems = PurchaseItem::with('purchase')
                    ->where('product_id', $product_id[$key])
                    ->where('stock_status', 1)
                    ->get();

                // Multiple Product
                foreach ($purchaseItems as $purchaseItem) {
                    $purchase_item_id       = $purchaseItem->id;
                    $pre_quantity           = $purchaseItem->quantity;
                    $pre_stock_out          = $purchaseItem->stock_out;
                    $pre_stock_available    = $purchaseItem->stock_available;

                    // 'purchase_items' Stock Calculation and Update
                    if ($need_qty > $pre_stock_available) {
                        $total_stock_out    = $pre_stock_out + $pre_stock_available;
                        $qty_stock_out      = $pre_stock_available;
                        $need_qty           = $need_qty - $pre_stock_available;
                    } else {
                        $total_stock_out    = $pre_stock_out + $need_qty;
                        $qty_stock_out      = $need_qty;
                        $need_qty           = 0;
                    }
                    // 'purchase_items' Stock Update
                    $update = PurchaseItem::find($purchase_item_id);
                    $update->stock_out          = $total_stock_out;
                    $update->stock_available    = $pre_quantity - $total_stock_out;
                    $update->stock_status       = ($pre_quantity - $total_stock_out == 0) ? 0 : 1 ;
                    $update->save();

                    // Insert 'sale_item_lists' table
                    $sale_item_list = new SaleItemList();
                    $sale_item_list->user_id            = Auth::user()->id;
                    $sale_item_list->sale_id            = $sale_insert->id;
                    $sale_item_list->sale_item_id       = $sale_item_insert->id;
                    $sale_item_list->purchase_item_id   = $purchase_item_id;
                    $sale_item_list->qty                = $qty_stock_out;
                    $sale_item_list->save();

                    if ($need_qty == 0) {
                        break;
                    }
                }

                // Update "products" table total stock decrease for this product (old_stock - new_stock)
                $product_stock = Product::whereId($product_id[$key])->firstOrFail();
                $product_stock->stock = $product_stock->stock - $quantity[$key];
                $product_stock->save();
            }

            // Update 'order' table
            Order::whereId($order_id)->update(['sale_status' => true]);

            DB::commit();

            notify()->success("Sale Created Successfully", "Success");
            return redirect()->back();

        } catch (QueryException $exception) {
            DB::rollBack();
            //return $exception->getMessage();
            notify()->warning($exception->getMessage(), "Error");
            return redirect()->back();
        }
    }

}
