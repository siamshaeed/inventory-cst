<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $brands = Ware::orderByDesc('id')->get();
        if ($request->ajax()) {
            $warehouses = Warehouse::orderByDesc('id')->get();
            return Datatables::of($warehouses)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'warehouses';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'warehouse';
                    $details                = false;
                    $tbl_name               = 'warehouses';
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

        return view('warehouse.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = new Warehouse();
        $warehouse->name    = $request->name;
        $warehouse->title   = $request->title;
        $warehouse->address = $request->address;
        $warehouse->slug    = Str::slug($request->name);
        $warehouse->save();

        notify()->success("Warehouse Created Successfully", "Success");
        return redirect()->route('warehouse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name'      => 'required|min:3|max:100|unique:brands,name,'.$warehouse->id,
            'title'     => 'max:100',
            'address'   => 'max:150'
        ]);

        $warehouse->findOrFail($warehouse->id);
        $warehouse->name    = $request->name;
        $warehouse->title   = $request->title;
        $warehouse->address = $request->address;
        $warehouse->slug    = Str::slug($request->name);
        $warehouse->save();

        notify()->success("Warehouse Updated Successfully", "Success");
        return redirect()->route('warehouse.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
