<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Division;
use App\Models\SupplierType;
use App\Http\Requests\StoreSupplierTypeRequest;
use App\Http\Requests\UpdateSupplierTypeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SupplierTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $supplier_types = SupplierType::with('suppliers')->orderByDesc('id')->get();
        if ($request->ajax()) {
            $supplier_types = SupplierType::with('suppliers')->orderByDesc('id')->get();
            return Datatables::of($supplier_types)
                ->addIndexColumn()

                ->addColumn('define_times', function ($row) {
                    //How many times has been used into Product Table
                    return $row->suppliers->count();
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'supplier_types';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id             = $row->id;
                    $module         = 'supplier-type';
                    $details        = false;
                    $tbl_name       = 'supplier_types';
                    $tbl_foreign_id = 'supplier_type_id';
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'tbl_name', 'tbl_foreign_id']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('supplier_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3|max:100',
        ]);

        $supplier_type = new SupplierType();
        $supplier_type->name    = $request->name;
        $supplier_type->title   = $request->title;
        $supplier_type->address = $request->address;
        $supplier_type->slug    = Str::slug($request->name);
        $supplier_type->save();

        notify()->success("Supplier-Type Created Successfully", "Success");
        return redirect()->route('supplier_type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierType  $supplierType
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierType $supplierType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierType  $supplierType
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierType $supplierType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierTypeRequest  $request
     * @param  \App\Models\SupplierType  $supplierType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierTypeRequest $request, SupplierType $supplierType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierType  $supplierType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierType $supplierType)
    {
        //
    }
}
