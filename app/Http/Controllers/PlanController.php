<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Plan;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $plans = Plan::orderByDesc('id')->get();
            return Datatables::of($plans)
                ->addIndexColumn()

                ->addColumn('define_duration_type', function ($row) {
                    if($row->duration_type == 1){
                        return 'Daily';
                    }elseif($row->duration_type == 2){
                        return 'Weekly';
                    }elseif($row->duration_type == 3){
                        return 'Monthly';
                    }elseif($row->duration_type == 4){
                        return 'Yearly';
                    }
                })
                ->rawColumns(['define_duration_type'])

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'plans';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'plan';
                    $details = false;
                    return view('common.action', compact(['id', 'module', 'details']));
                })
                ->rawColumns(['action'])
                ->toJson();

        }

        //notify()->success("Success Message on easy", "Success");
        return view('plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Plan $plan)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3|max:100',
            'price'         => 'required',
            'total_days'    => 'required',
            'duration_type' => 'required',
            'trial_days'    => 'required',
            'description'   => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            //--data save
            $plan->name             = $request->name;
            $plan->price            = $request->price;
            $plan->total_days       = $request->total_days;
            $plan->duration_type    = $request->duration_type;
            $plan->trial_days       = $request->trial_days;
            $plan->description      = $request->description;
            $plan->save();

            return response()->json([
                'status ' => 200,
                'success' => 'Successfully Plan Created',
            ]);
        }
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
        $plan = Plan::findOrFail($id);
        return view('plan.edit', compact(['plan']));
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
        //dd($request->all());
        $request->validate([
            'name'          => 'required|min:3|max:100',
            'price'         => 'required',
            'total_days'    => 'required',
            'duration_type' => 'required',
            'trial_days'    => 'required',
            'description'   => 'required',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->name             = $request->name;
        $plan->price            = $request->price;
        $plan->total_days       = $request->total_days;
        $plan->duration_type    = $request->duration_type;
        $plan->trial_days       = $request->trial_days;
        $plan->description      = $request->description;
        $plan->status           = ($request->status == 'on' ? 1 : 0);
        $plan->save();

        notify()->success("Plan Updated", "Success");
        return redirect()->route('plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Plan::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }

}
