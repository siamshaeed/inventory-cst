<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Upazila;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $upazilas = Upazila::orderByDesc('id')->take(100)->get();;
            return Datatables::of($upazilas)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'upazilas';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'upazila';
                    $details    = false;
                    $tbl_name               = 'upazilas';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'user_name', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        $districts = District::get();
        return view('frontend.upazila.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts =  District::get();

        return view('frontend.upazila.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upazila = new Upazila();

        $upazila->name        = $request->name;
        $upazila->bn_name     = $request->name_bn;
        $upazila->district_id = $request->district_id;
        $upazila->status      = ($request->status == 'on') ? 1 : 0;
        $upazila->save();

        notify()->success("Upazila inserted Successfully", "Success");
        return redirect()->route('upazila.index');
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
        $upazila =  Upazila::findOrFail($id);
        $districts = District::get();

        return view('frontend.upazila.edit', compact('upazila', 'districts'));
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
        $upazila = Upazila::findOrFail($id);

        $upazila->name          = $request->name;
        $upazila->bn_name       = $request->name_bn;
        $upazila->district_id   = $request->division_id;
        $upazila->status        = ($request->status == 'on') ? 1 : 0;
        $upazila->save();

        notify()->success("Upazila Update Successfully", "Success");
        return redirect()->route('upazila.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Upazila::findOrFail($id);
        $deleted->delete();
        return back();
    }
}
