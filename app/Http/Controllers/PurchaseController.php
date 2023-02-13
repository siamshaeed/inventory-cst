<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Purchase;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\PurchaseDue;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Traits\PurchasePaymentStatusTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PurchaseController extends Controller
{
    use PurchasePaymentStatusTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $purchase = Purchase::orderByDesc('id')->get();

        if ($request->ajax()) {

            $purchase = Purchase::orderByDesc('id')->get();

            return Datatables::of($purchase)
                ->addIndexColumn()
                ->addColumn('define_invoice_number', function ($row) {
                    $id = $row->id;
                    $invoice_number = $row->invoice_number;
                    return view('purchase.field_invoice_number', compact(['id', 'invoice_number']));
                })
                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('purchase.field_date', compact(['date']));
                })
                ->addColumn('define_grand_amount', function ($row) {
                    $id = $row->id;
                    $grand_amount = $row->grand_amount;
                    return view('purchase.field_grand_amount', compact(['id', 'grand_amount']));
                })
                ->addColumn('define_total_amount', function ($row) {
                    $id = $row->id;
                    $total_amount = $row->total_amount;
                    return view('purchase.field_total_amount', compact(['id', 'total_amount']));
                })
                ->addColumn('define_payment_status', function ($row) {
                    return view('purchase.field_payment_status', compact(['row']));
                })
                ->addColumn('define_purchase_status', function ($row) {
                    return view('purchase.field_purchase_status', compact(['row']));
                })
                ->addColumn('action', function ($row) {

                    return '<a  href="' . route('purchase.edit', $row->id) . '"
                                class="btn btn-sm btn-primary"
                                data-toggle="tooltip"
                                data-modal_title="Edit Purchase"
                                title="Edit">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a  onclick="return confirm(\'are you sure?\')"
                                href="' . route('purchase.destroy', $row->id) . '"
                                class="btn btn-sm btn-danger"
                                data-toggle="tooltip"
                                data-modal_title="Delete Purchase"
                                title="Delete">
                               <i class="fa fa-trash"></i>
                            </a>
                            ';

                    //return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with(['good'])->whereStatus(true)->get();
        $brands = Brand::whereStatus(true)->get();
        $suppliers = Supplier::with(['market_type'])->whereStatus(true)->get();
        return view('purchase.create', compact('products', 'brands', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePurchaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();

        /*
         * Validation check
         */

        $request->validate([
            'date' => 'required',
            'invoice' => 'required',
            'supplier_id' => 'required',
            'purchase_status_type' => 'required',
        ]);

        // Purchase info
        $date                   = $request->date;
        $invoice                = $request->invoice;
        $supplier_id            = $request->supplier_id;
        $purchase_status_type   = $request->purchase_status_type;

        // Items info
        $product_id     = $request->product_id;
        $quantity       = $request->quantity;
        $unit_price     = $request->unit_price;
        $discount       = $request->discount;
        $sub_total      = $request->sub_total;
        $selling_price  = $request->selling_price;

        // Grand total price
        $grand_total    = $request->grand_total;
        $total_discount = $request->total_discount;
        $total_amount   = $request->total_amount;
        $total_pay      = $request->total_pay;
        $total_due      = $request->total_due;

        $payment_status = $this->paymentStatus($total_amount, $total_pay, $total_due);
        $due_status = $this->dueStatus($total_amount, $total_pay);
        //dd($request->all());

        DB::beginTransaction();
        try {
            // Insert purchases table
            $purchase = new Purchase();
            $purchase->user_id          = auth()->user()->id;
            $purchase->supplier_id      = $supplier_id;
            $purchase->date             = $date;
            $purchase->invoice_number   = $invoice;
            $purchase->purchase_status  = $purchase_status_type;
            $purchase->grand_amount     = $grand_total;
            $purchase->total_discount   = $total_discount;
            $purchase->total_amount     = $total_amount;
            $purchase->total_pay        = $total_pay;
            $purchase->total_due        = $total_due;
            $purchase->payment_status   = $payment_status;
            $purchase->save();

            // Insert purchase_dues table
            $purchase_due = new PurchaseDue();
            $purchase_due->user_id      = auth()->user()->id;
            $purchase_due->purchase_id  = $purchase->id;
            $purchase_due->amount       = $total_amount;
            $purchase_due->pay          = $total_pay;
            $purchase_due->due          = $total_due;
            //$purchase_due->status       = $due_status;
            $purchase_due->save();

            // Insert items table
            foreach ($product_id as $key => $value) {

                $item = new PurchaseItem();
                $item->purchase_id      = $purchase->id; //now getting Last inserted id
                $item->product_id       = $product_id[$key];
                //$item->warehouse_id     = $request->warehouse_id;
                $item->user_id          = auth()->user()->id;
                $item->trade_type       = 1;
                $item->quantity         = $quantity[$key];
                $item->unit_price       = $unit_price[$key];
                $item->discount         = $discount[$key];
                $item->sub_total        = $sub_total[$key];
                $item->selling_price    = $selling_price[$key];
                $item->stock_available  = $quantity[$key];
                $item->save();

                // Update stock increase for this product (old_stock + new_stock)
                $product_stock = Product::whereId($product_id[$key])->firstOrFail();
                $product_stock->stock = $product_stock->stock + $quantity[$key];
                $product_stock->save();
            }

            DB::commit();

            notify()->success('Purchase Save Successful', 'Success');

            return redirect()->route('purchase.index');

        } catch (QueryException $exception) {

            DB::rollBack();
            //return $exception->getMessage();
            notify()->warning($exception->getMessage(), "Error");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //return $purchase;
        $items          = PurchaseItem::with(['purchase', 'product'])->wherePurchaseId($purchase->id)->get();
        $purchase_dues  = PurchaseDue::wherePurchaseId($purchase->id)->get();
        $total_pay      = $purchase_dues->sum('pay');

        $products   = Product::with(['good'])->whereStatus(true)->get();
        $brands     = Brand::whereStatus(true)->get();
        $suppliers  = Supplier::with(['market_type'])->whereStatus(true)->get();

        return view('purchase.show', compact('purchase', 'items', 'purchase_dues', 'total_pay', 'products', 'brands', 'suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {

        $products = Product::with(['good'])->whereStatus(true)->get();

        $suppliers = Supplier::with(['market_type'])->whereStatus(true)->get();

        return view('purchase.edit', compact('products', 'suppliers', 'purchase'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePurchaseRequest $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {

        #dd($request->all());
 

  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
