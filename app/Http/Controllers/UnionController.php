<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $unions = Union::orderByDesc('id')->take(100)->get();
            return Datatables::of($unions)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'unions';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'union';
                    $details    = false;
                    $tbl_name               = 'unions';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'user_name', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

//        $districts = District::get();
        return view('frontend.union.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $upazilas =  Upazila::get();

        return view('frontend.union.create', compact('upazilas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $union = new Union();

        $union->name        = $request->name;
        $union->bn_name     = $request->name_bn;
        $union->upazila_id  = $request->upazila_id;
        $union->status      = ($request->status == 'on') ? 1 : 0;
        $union->save();

        notify()->success("Union inserted Successfully", "Success");
        return redirect()->route('union.index');
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
        $union = Union::findOrFail($id);
        $upazilas =  Upazila::get();
        return view('frontend.union.edit', compact('union', 'upazilas'));
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
        $union = Union::findOrFail($id);

        $union->name        = $request->name;
        $union->bn_name     = $request->name_bn;
        $union->upazila_id  = $request->division_id;
        $union->status      = ($request->status == 'on') ? 1 : 0;
        $union->save();

        notify()->success("Union Update Successfully", "Success");
        return redirect()->route('union.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Union::findOrFail($id);
        $deleted->delete();
        return back();
    }
}
