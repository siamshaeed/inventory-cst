<?php

namespace App\Http\Controllers;

use App\Models\MarketType;
use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$suppliers = Supplier::with('market_type')->orderByDesc('id')->get();
        if ($request->ajax()) {
            $suppliers = Supplier::with('market_type')->orderByDesc('id')->get();
            return Datatables::of($suppliers)
                ->addIndexColumn()

                //--MarketType Name
                ->addColumn('define_market_type_name', function ($row) {
                    $market_type_name  = $row->market_type->name;
                    return view('supplier.supplier_market_type_name', compact(['market_type_name']));
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'suppliers';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'supplier';
                    $tbl_name               = 'suppliers';
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

        return view('supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marketTypes = MarketType::whereStatus(true)->get();
        return view('supplier.create', compact('marketTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier();
        $supplier->market_type_id   = $request->market_type_id;
        $supplier->name             = $request->name;
        $supplier->title            = $request->title;
        $supplier->phone            = $request->phone;
        $supplier->address          = $request->address;
        $supplier->slug             = Str::slug($request->name);
        $supplier->save();

        notify()->success("Supplier Created Successfully", "Success");
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $supplier       = Supplier::with('market_type')->findOrFail($supplier->id);
        $marketTypes    = MarketType::whereStatus(true)->get();
        return view('supplier.edit', compact(['supplier', 'marketTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'market_type_id'    => 'required',
            'name'              => 'required|min:3|max:60',
            'title'             => 'max:100',
            'phone'             => 'required|digits:11|unique:suppliers,phone,'.$supplier->id,
            'address'           => 'max:150'
        ]);

        $supplier->findOrFail($supplier->id);
        $supplier->market_type_id   = $request->market_type_id;
        $supplier->name             = $request->name;
        $supplier->title            = $request->title;
        $supplier->address          = $request->address;
        $supplier->slug             = Str::slug($request->name);
        $supplier->save();

        notify()->success("Supplier Updated Successfully", "Success");
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
