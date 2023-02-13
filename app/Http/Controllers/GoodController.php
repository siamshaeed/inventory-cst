<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Good;
use App\Http\Requests\StoreGoodRequest;
use App\Http\Requests\UpdateGoodRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $goods = Good::with('products')->orderByDesc('id')->get();
        if ($request->ajax()) {
            $goods = Good::with('products')->orderByDesc('id')->get();
            return Datatables::of($goods)
                ->addIndexColumn()

                //--Goods Name
                ->addColumn('define_name', function ($row) {
                    $name           = $row->name;
                    $times_product  = $row->products->count();
                    return view('good.field_name', compact(['name', 'times_product']));
                })

                // How many times use
                ->addColumn('define_times', function ($row) {
                    $times_product = $row->products->count();
                    return view('good.define_times', compact(['times_product']));
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'goods';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'good';
                    $details                = false;
                    $tbl_name               = 'goods';
                    $tbl_foreign_id         = 'good_id';
                    $tbl_foreign_tbl_name   = 'products';
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('good.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('good.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:goods',
        ]);

        $good = new Good();
        $good->name    = $request->name;
        $good->slug    = Str::slug($request->name);
        $good->save();

        notify()->success("Goods Created Successfully", "Success");
        return redirect()->route('good.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good)
    {
        return view('good.edit', compact('good'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoodRequest  $request
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Good $good)
    {
        $request->validate([
            'name'  => 'required|min:3|max:100|unique:goods,name,'.$good->id,
        ]);

        $good->findOrFail($good->id);
        $good->name    = $request->name;
        $good->slug    = Str::slug($request->name);
        $good->save();

        notify()->success("Goods Updated Successfully", "Success");
        return redirect()->route('good.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
        //
    }
}
