<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $categories = Category::with('products')->where('type', 1)->orderByDesc('id')->get();
        if ($request->ajax()) {
            $categories = Category::with('products')->where('type', 1)->orderByDesc('id')->get();
            return Datatables::of($categories)
                ->addIndexColumn()

                ->addColumn('define_times', function ($row) {
                    //How many times has been used into Product Table
                    return $row->products->count();
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
                    $tbl_foreign_tbl_name   = 'products';
                    return view('destroy.destroy', compact(['id', 'module', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            //'name' => 'required|min:3|max:100|unique:categories|alpha',
            'name' => 'required|regex:/^[a-zA-ZÑñ\s]+$/|min:3|max:100',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        notify()->success("Category Created Successfully", "Success");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //'name' => 'required|min:3|alpha|max:100|unique:categories,name,'.$id,
            'name' => 'required|regex:/^[a-zA-ZÑñ\s]+$/|min:3|max:100',
        ]);

        $category = Category::findOrFail($id);
        $category->name     = $request->name;
        $category->slug     = Str::slug($request->name . '-' . $id);
        $category->status   = ($request->status == 'on') ? 1 : 0;
        $category->save();

        notify()->success("Update Successfully", "Success");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
