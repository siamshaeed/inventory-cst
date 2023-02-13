<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Events\RealTimeNotificationEvent;
use App\Models\District;
use App\Models\Division;
use App\Models\ServiceCategory;
use App\Http\Resources\WorkshopResource;
use App\Models\ServiceList;
use App\Models\ServiceRequest;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\File;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect()->route('service.type.index', 'workshop');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchWorkshop(Request $request)
    {
        return view('frontend.workshops.search-workshop');
    }



    public function getLocation()
    {
        return view('frontend.workshops.search-location');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function workshopList(Request $request): ResourceCollection
    {
        $workshops = Workshop::with('serviceFeedback:id,workshop_id,rating')
            ->withCount('serviceFeedback')
            ->get();

        return WorkshopResource::collection($workshops);
    }



    public function nearestWorkshop(Request $request)
    {
        return view('frontend.workshops.list-workshop');
    }

    public function workshopDetails(Request $request)
    {
        $serviceRequest = ServiceRequest::find($request->sid);
        $workshop = Workshop::with(['divisions', 'districts', 'upazilas', 'unions', 'serviceFeedback'])
            ->where('user_id', auth()->id())
            ->first();


        return view('frontend.workshops.workshop-details', compact('workshop', 'serviceRequest'));
    }

    public function workshopProfile(Request $request)
    {
        $workshop = Workshop::with(['divisions', 'districts', 'upazilas', 'unions'])->where('user_id', auth()->user()->id)->first();
        $service_requests = ServiceRequest::with(['user', 'workshop', 'service_list'])->get();

        return view('frontend.workshops.workshop-profile', compact('workshop', 'service_requests'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$divisions = [];
        $divisions  = Division::where('status', 1)->get();
        $districts  = District::where('status', 1)->get();
        $upazilas   = Upazila::where('status', 1)->get();
        $unions     = Union::where('status', 1)->get();

        return view('frontend.workshops.create', compact('divisions', 'districts', 'upazilas', 'unions'));
    }

    public function user()
    {
        $divisions = [];
        return view('frontend.workshops.user', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workshop $workshop)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'              => 'required|max:80',
//            'division_id'       => 'required',
//            'district_id'       => 'required',
//            'upazila_id'        => 'required',
//            'union_id'          => 'required',
            'address'           => 'required|max:200',
//            'contact_no'        => 'required|max:15',
            'license_number'    => 'required|max:25',
            'latitude'          => 'required|max:200',
            'longitude'         => 'required|max:200',
            'description'       => 'max:1000',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
                'data' => $request->all(),
            ]);

        }else{

            //--data Save
            $workshop->user_id = auth()->id();
            $workshop->type = 3;
            $workshop->name = $request->name;
            $workshop->description = $request->description;
            $workshop->logo = $request->logo;
            $workshop->signature = $request->signature;
            $workshop->latitude = $request->latitude;
            $workshop->longitude = $request->longitude;
            $workshop->license_number = $request->license_number;
            $workshop->division_id = $request->division_id;
            $workshop->district_id = $request->district_id;
            $workshop->upazila_id = $request->upazila_id;
            $workshop->union_id = $request->union_id;
            $workshop->address = $request->address;
            $workshop->zip_code = $request->zip_code;
            $workshop->contact_no = $request->contact_no;
            $workshop->opening_time = $request->opening_time;
            $workshop->closing_time = $request->closing_time;
            if ($request->has('image')) {
                $image = uploadImage($request->image, "images/workshop/logo/");
                $workshop->logo = $image;
            }

            /*if ($request->has('images_signature')) {
                $image = uploadImage($request->images_signature, "images/workshop/signature/");
                $workshop->signature = $image;
            }
            if ($request->has('image_cover_photo')) {
                $image = uploadImage($request->image_cover_photo, "images/workshop/cover_photo/");
                $workshop->cover_photo = $image;
            }*/
            $workshop->save();

            return response()->json([
                'status' => 200,
                'success' => "Workshop Created Successfully",
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
    public function edit(Workshop $workshop)
    {
        return 'okey workshp';
        $workshop->with(['divisions', 'districts', 'upazilas', 'unions'])->first();
        //$divisions = [];
        $divisions  = Division::where('status', 1)->get();
        $districts  = District::where('status', 1)->get();
        $upazilas   = Upazila::where('status', 1)->get();
        $unions     = Union::where('status', 1)->get();

        return view('frontend.workshops.edit', compact('workshop', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        //dd($request->all());
        $request->validate([
            'name'              => 'required|max:80',
//            'division_id'       => 'required',
//            'district_id'       => 'required',
//            'upazila_id'        => 'required',
//            'union_id'          => 'required',
            'address'           => 'required|max:200',
            'contact_no'        => 'required|max:15',
            'license_number'    => 'required|max:25',
            'latitude'          => 'required|max:200',
            'longitude'         => 'required|max:200',
            'description'       => 'max:1000',
        ]);

        $workshop->name = $request->name;
        $workshop->description = $request->description;
        $workshop->logo = $request->logo;
        $workshop->signature = $request->signature;
        $workshop->latitude = $request->latitude;
        $workshop->longitude = $request->longitude;
        $workshop->license_number = $request->license_number;
        $workshop->division_id = $request->division_id;
        $workshop->district_id = $request->district_id;
        $workshop->upazila_id = $request->upazila_id;
        $workshop->union_id = $request->union_id;
        $workshop->address = $request->address;
        $workshop->zip_code = $request->zip_code;
        $workshop->contact_no = $request->contact_no;
        $workshop->opening_time = $request->opening_time;
        $workshop->closing_time = $request->closing_time;
        /*if ($request->has('image_logo')) {
            $image = uploadImage($request->image_logo, "images/workshop/logo/");
            $workshop->logo = $image;
        }*/

        if ($request->image) {
            $image = uploadImage($request->image, "images/workshop/logo/");
            $workshop->logo = $image;
        }



        /*if ($request->has('images_signature')) {
            $image = uploadImage($request->images_signature, "images/workshop/signature/");
            $workshop->signature = $image;
        }
        if ($request->has('image_cover_photo')) {
            $image = uploadImage($request->image_cover_photo, "images/workshop/cover_photo/");
            $workshop->cover_photo = $image;
        }*/
        $workshop->save();

        notify()->success("Workshop Updated", "Success");
        return redirect()->route('workshops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Workshop::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }
}
