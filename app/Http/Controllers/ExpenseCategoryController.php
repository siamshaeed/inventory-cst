<?php

namespace App\Http\Controllers;

use App\Models\Blog\Category;
use App\Models\ExpenseCategory;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $categories = Category::with('expenses')->where('type', 2)->orderByDesc('id')->get();
        if ($request->ajax()) {
            $categories = Category::with('expenses')->where('type', 2)->orderByDesc('id')->get();
            return Datatables::of($categories)
                ->addIndexColumn()

                ->addColumn('define_times', function ($row) {
                    //How many times has been used into Product Table
                    return $row->expenses->count();
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'categories';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'category';
                    $tbl_name               = 'categories';
                    $tbl_foreign_id         = 'category_id';
                    $tbl_foreign_tbl_name   = 'expenses';
                    return view('destroy.destroy', compact(['id', 'module', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('expense_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            //'name' => 'required|min:3|max:100|unique:categories|alpha',
            'name' => 'required|min:3|max:100',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->type = 2;
        $category->slug = Str::slug($request->name . '-2');
        $category->save();

        notify()->success("Expense Category Created Successfully", "Success");
        return redirect()->route('expense-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseCategoryRequest  $request
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        //
    }
}
