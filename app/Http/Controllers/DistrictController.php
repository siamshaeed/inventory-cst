<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
//        return $district = District::orderByDesc('id')->get();
        if ($request->ajax()) {
            $districts = District::orderByDesc('id')->get();
            return Datatables::of($districts)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'districts';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'district';
                    $details    = false;
                    $tbl_name               = 'districts';
                    $tbl_foreign_id         = null;
                    $tbl_foreign_tbl_name   = null;
                    return view('destroy.destroy', compact(['id', 'module', 'details', 'user_name', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        $districts = District::get();
        return view('frontend.district.index', compact('districts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions =  Division::get();

        return view('frontend.district.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $district = new District();

        $district->name         = $request->name;
        $district->bn_name      = $request->name_bn;
        $district->division_id  = $request->division_id;
        $district->status       = ($request->status == 'on') ? 1 : 0;
        $district->save();

        notify()->success("District inserted Successfully", "Success");
        return redirect()->route('district.index');
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
        $district = District::findOrFail($id);
        $divisions =  Division::get();
        return view('frontend.district.edit', compact('district', 'divisions'));
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
        $district = District::findOrFail($id);

        $district->name         = $request->name;
        $district->bn_name      = $request->name_bn;
        $district->division_id  = $request->division_id;
        $district->status       = ($request->status == 'on') ? 1 : 0;
        $district->save();

        notify()->success("District Update Successfully", "Success");
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = District::findOrFail($id);
        $deleted->delete();
        return back();
    }
}
