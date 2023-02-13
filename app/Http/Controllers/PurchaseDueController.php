<?php

namespace App\Http\Controllers;

use App\Models\Blog\Category;
use App\Models\Purchase;
use App\Models\PurchaseDue;
use App\Http\Requests\StorePurchaseDueRequest;
use App\Http\Requests\UpdatePurchaseDueRequest;
use App\Traits\PurchasePaymentStatusTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PurchaseDueController extends Controller
{
    use PurchasePaymentStatusTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('purchase.index');
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
     * @param \App\Http\Requests\StorePurchaseDueRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PurchaseDue $purchaseDue
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $purchase_id)
    {
        $purchase = Purchase::with('supplier')->whereId($purchase_id)->first();

        if (is_null($purchase)) {
            notify()->warning("Please, Enter valid information", "Warning");
            return redirect()->back();
        }

        //dd($purchase);
        //return $purchase_dues = PurchaseDue::with(['purchase'])->wherePurchaseId($purchase_id)->get();

        if ($request->ajax()) {
            $purchase_dues = PurchaseDue::with(['purchase'])->wherePurchaseId($purchase_id)->get();
            return Datatables::of($purchase_dues)
                ->addIndexColumn()
                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('purchase_due.field_date', compact(['date']));
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'purchase-due';
                    $details = false;
                    $tbl_name = 'purchase_dues';
                    $tbl_foreign_id = $row->purchase->id;
                    $tbl_foreign_tbl_name = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('purchase_due.index', compact('purchase_id', 'purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PurchaseDue $purchaseDue
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_id)
    {
        $purchase_info = Purchase::whereId($purchase_id)->first();

        if (!$purchase_info) {

            notify()->warning("No Purchase Record Found", "Error");

            return redirect()->back();

        }


        if ($purchase_info->total_due < 0) {

            notify()->warning("No Due Amount Remain", "Error");

            return redirect()->back();

        }


        return view('purchase_due.edit', compact('purchase_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePurchaseDueRequest $request
     * @param \App\Models\PurchaseDue $purchaseDue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase_id)
    {
        /*
         * Validation check
         */

        $request->validate([
            'date' => 'required',
            'remain_amount' => 'required',
            'pay_amount' => 'required',
            'due_amount' => 'required',
        ]);

        /*
         * request value
         */

        $remain_amount = $request->remain_amount;
        $pay_amount = $request->pay_amount;
        $due_amount = $request->due_amount;
        $date = $request->date;

        #check pay amount is greater than remain amount

        if ($pay_amount > $remain_amount) {

            notify()->warning("Pay Amount not more than Remaining Amount", "warning");

            return redirect()->back();
        }

        #check pay amount is greater than 0

        if ($pay_amount <= 0) {

            notify()->warning("Pay Amount Should greater than 0", "warning");

            return redirect()->back();
        }


        $purchase = Purchase::whereId($purchase_id)->first();

        #check Purchase record exist or not

        if (is_null($purchase)) {

            notify()->warning("Something Went Wrong !", "warning");

            return redirect()->back();
        }

        #purchase table data
        $total_amount = $purchase->total_amount;
        $total_paid = $purchase->total_pay;
        $total_due = $purchase->total_due;


        /*
         * DB Begin Transaction
         */

        DB::beginTransaction();

        try {

            #set default value
            $status = 0;

            #set status according to due amount
            if ($due_amount == 0 || $due_amount == 0.0 || $due_amount == 0.00) {
                $status = 1;
            }

            /*
             * Due Payment History
             */

            $due = new PurchaseDue();
            $due->user_id = auth()->user()->id;
            $due->purchase_id = $purchase_id;
            $due->date = $date;
            $due->amount = $remain_amount;
            $due->pay = $pay_amount;
            $due->due = $due_amount;
            $due->status = ($status == 0) ? 1 : 2;

            $due->save();


            /*
             * Purchase tabel update
             */

            $purchase->total_pay = $purchase->total_pay + $pay_amount;
            $purchase->total_due = $due_amount;
            $purchase->payment_status = ($status == 1) ? 3 : $purchase->payment_status;
            $purchase->update();


            #start DB commit operation
            DB::commit();

            notify()->success("Due Payment Pay Successfully", "Success");

            return redirect()->route('purchase-due.show', $purchase_id);

        } catch (QueryException $exception) {

            DB::rollBack();

            notify()->warning($exception->getMessage(), "Error");

            return redirect()->back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PurchaseDue $purchaseDue
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDue $purchaseDue)
    {
        notify()->warning('To Do List', "Error");

        return redirect()->back();
    }

    public function purchaseDuePay($purchase_id)
    {
        //return $purchase_id;
        //return 'okey';
        //$purchase_info = Purchase::findOrFail($purchase_id)->first();
        //$nas = 'nasim';
        return view('purchase_due.create');
    }
}
