<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalePayment;
use App\Http\Requests\StoreSalePaymentRequest;
use App\Http\Requests\UpdateSalePaymentRequest;
use App\Traits\PurchasePaymentStatusTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SalePaymentController extends Controller
{
    use PurchasePaymentStatusTrait;
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
        return 'Create Controller';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalePaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $sale_id)
    {
        $sale = Sale::with(['order'])->find($sale_id);
        if (is_null($sale)) {
            notify()->warning("Whoops! Something Went Wrong.", "warning");
            return redirect()->route('sale.index');
        }
        //return $sale_payments = SalePayment::whereSaleId($sale_id)->get();

        if ($request->ajax()) {
            $sale_payments = SalePayment::whereSaleId($sale_id)->get();
            return Datatables::of($sale_payments)
                ->addIndexColumn()

                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('sale_payment.field_date', compact(['date']));
                })

                ->addColumn('define_status', function ($row) {
                    return view('sale_payment.common_field_payment_status', compact(['row']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'sale-payment';
                    $details                = false;
                    $tbl_name               = 'sale_payments';
                    $tbl_foreign_id         = $row->sale_id;
                    $tbl_foreign_tbl_name   = 'sales';
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('sale_payment.index', compact(['sale_id', 'sale']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function edit($sale_id)
    {
        $sale = Sale::whereId($sale_id)->first();
        if ($sale->total_due < 0) {
            notify()->warning("No Due Amount Remain", "Error");
            return redirect()->back();
        }

        return view('sale_payment.edit', compact(['sale']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalePaymentRequest  $request
     * @param  \App\Models\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalePaymentRequest $request, $sale_id)
    {
        //dd($request->all());
        $date           = $request->date;
        $remain_amount  = $request->remain_amount;
        $pay_amount     = $request->pay_amount;
        $due_amount     = $request->due_amount;

        // Retrieve total_amount from 'sale' table
        $sale = Sale::findOrFail($sale_id);
        $total_amount = $sale->total_amount;

        DB::beginTransaction();
        try{
            // Insert 'sale_payments' table
            SalePayment::create([
                'user_id'   => Auth::user()->id,
                'sale_id'   => $sale_id,
                'date'      => $date,
                'amount'    => $remain_amount,
                'pay'       => $pay_amount,
                'due'       => $due_amount,
                'status'    => ($due_amount > 0 ) ? 1 : 2, //1=unPaid, 2=Paid
            ]);

            // Retrieve total_pay from 'sale_payments' table
            $salePayment    = SalePayment::whereSaleId($sale_id)->get();
            $total_pay      = $salePayment->sum('pay');
            $total_due      = $total_amount - $total_pay;

            // Update 'sales' table
            Sale::find($sale_id)->update([
                'total_amount'      => $total_amount,
                'total_pay'         => $total_pay,
                'total_due'         => $total_due,
                'payment_status'    => $this->paymentStatus($total_amount, $total_pay, $total_due),
            ]);
            DB::commit();

            notify()->success("Due Payment Successfully", "Success");
            return redirect()->route('sale-payment.show', $sale_id);

        } catch(QueryException $exception){
            DB::rollBack();
            notify()->warning($exception->getMessage(), "Error");
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalePayment  $salePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalePayment $salePayment)
    {
        //
    }
}
