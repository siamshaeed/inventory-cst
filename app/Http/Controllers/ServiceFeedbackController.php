<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\ServiceFeedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return ServiceFeedback::with(['user', 'workshop', 'service_request'])->get();

        if ($request->ajax()) {

            $service_feedback = ServiceFeedback::with(['user', 'workshop', 'service_request'])->get();
            return Datatables::of($service_feedback)
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

        return view('frontend.service_feedback.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceFeedback = ServiceFeedback::firstOrNew(
            [
                'service_request_id' => $request->service_request_id,
            ]
        );

        $serviceFeedback->workshop_id = $request->workshop_id;
        $serviceFeedback->user_id = auth()->id();
        $serviceFeedback->feedback = $request->feedback;
        $serviceFeedback->rating = $request->rating;
        $serviceFeedback->save();

        notify()->success('Thank you for your opinion', 'Success');

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
        //
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
        //
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
