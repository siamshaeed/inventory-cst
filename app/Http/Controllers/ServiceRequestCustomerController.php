<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceRequestCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $service_requests = ServiceRequest::with(['user', 'workshop', 'service_list'])
                ->has('workshop')
                ->where('customer_id', auth()->user()->id)
                ->orderByDesc('id')
                ->get();


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
                    $user_name  = $row->user->name;
                    $module = 'service-request-customer';
                    $details = false;
                    return view('frontend.service_request_customer.action', compact(['id', 'module', 'details', 'user_name', 'row']));
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('frontend.service_request_customer.index');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        return view('frontend.service_request_customer.show', compact('serviceRequest'));
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



    public function details(Request $request) {

        //dd($request->all());
        $id = $request->data_id;

        $service_requests = ServiceRequest::with(['user', 'workshop', 'service_list'])
            ->orderByDesc('id')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'success' => 'Successfully',
            'data' => $service_requests,
        ]);

    }
}
