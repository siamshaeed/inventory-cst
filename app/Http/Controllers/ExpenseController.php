<?php

namespace App\Http\Controllers;

use App\Models\Blog\Category;
use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $expenses = Expense::with('category')->orderByDesc('id')->get();
        if ($request->ajax()) {
            $expenses = Expense::with('category')->orderByDesc('id')->get();
            return Datatables::of($expenses)
                ->addIndexColumn()

                ->addColumn('define_category', function ($row) {
                    $expense_category_name = $row->category->name;
                    return view('expense.field_expense_category_name', compact(['expense_category_name']));
                })

                /*->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'expenses';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })*/

                //For amount
                ->addColumn('define_amount', function ($row) {
                    $amount = $row->amount;
                    return view('expense.amount', compact('amount'));
                })

                //Date formate
                ->addColumn('define_date', function ($row) {
                    $date = $row->date;
                    return view('expense.field_date', compact(['date']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'expense';
                    $tbl_name               = 'expenses';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('expense.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expence_categorys =  Category::where('type', '2')->where('status', '1')->get();

        return view('expense.create', compact('expence_categorys'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
//        return $request->all();
        $expense    = new Expense();
        $expense->category_id    = $request->category_id;
        $expense->user_id        = auth::user()->id;
        $expense->title          = $request->title;
        $expense->amount         = $request->amount;
        $expense->date           = $request->date;

        $expense->save();

        notify()->success("Expense Created Successfully", "Success");
        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $expense_categories = Category::where('type', '2')->get();

        return view('expense.edit', compact('expense_categories','expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseRequest  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {

        $expense->category_id    = $request->category_id;
        $expense->user_id        = auth::user()->id;
        $expense->title          = $request->title;
        $expense->amount         = $request->amount;
        $expense->date         = $request->date;

        $expense->save();

        notify()->success("Expense Update Successfully", "Success");
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
