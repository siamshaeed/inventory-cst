<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Division;
use Yajra\DataTables\DataTables;


class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Division::get();
        if ($request->ajax()) {
            $plans = Division::orderByDesc('id')->get();
            return Datatables::of($plans)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'divisions';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'division';
                    $details    = false;
                    $tbl_name               = 'divisions';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'user_name', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        $divisions = Division::get();
        return view('frontend.division.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.division.create');
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
            'name'      => 'required|min:3|max:60',
            'name_bn'   => 'required',
        ]);

        $division = new Division();

        $division->name        = $request->name;
        $division->bn_name     = $request->name_bn;
        $division->status      = ($request->status == 'on') ? 1 : 0;
        $division->save();

        notify()->success("Division inserted Successfully", "Success");
        return redirect()->route('division.index');
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
        $division = Division::findOrFail($id);
        return view('frontend.division.edit', compact('division'));
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
            'name'      => 'required|min:3|max:60',
            'name_bn'   => 'required',
        ]);

        $division = Division::findOrFail($id);

        $division->name        = $request->name;
        $division->bn_name     = $request->name_bn;
        $division->status      = ($request->status == 'on') ? 1 : 0;
        $division->save();

        notify()->success("Division Update Successfully", "Success");
        return redirect()->route('division.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Division::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }
}
