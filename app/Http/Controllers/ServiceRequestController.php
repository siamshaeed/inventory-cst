<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workshop_id = auth()->user()->workshop->id;

        if ($request->ajax()) {

            $service_requests = ServiceRequest::with(['user', 'workshop', 'service_list'])
                ->where('workshop_id', $workshop_id)
                ->orderByDesc('id')->get();
            return Datatables::of($service_requests)
                ->addIndexColumn()
                ->editColumn('customer_request_time', function ($row) {
                    return $row->customer_request_time->diffForHumans();
                })
                ->editColumn('workshop_response_time', function ($row) {
                    if ($row->workshop_response_time) {
                        return $row->workshop_response_time->diffForHumans();
                    }

                    return 'Not Responded';
                })
                ->editColumn('workshop_distance', function ($row) {
                    return $row->getDistance() . ' km';
                })

                ->addColumn('define_status', function ($row) {
                    return getServiceStatus($row->status);
                })


                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'service-request';
                    $details = false;
                    return view('common.service-request.action', compact(['id', 'module', 'details', 'row']));
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('frontend.workshop_service_request.index');
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
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return response()->json(
            [
                'message' => 'Request has been deleted'
            ]
        );
    }


    /**
     * @param Request $request
     * @param ServiceRequest $serviceRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, ServiceRequest $serviceRequest)
    {
        $serviceRequest->status = $request->status;
        $serviceRequest->save();

        return response()->json(
            [
                'message' => 'Request has been ' . config('default.request.status')[$request->status]
            ]
        );
    }

}
