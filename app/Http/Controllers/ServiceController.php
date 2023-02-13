<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        //--When Incomplete Workshop Profile
        /*$workshop = Workshop::where('user_id', auth()->user()->id)->first();
        if(is_null($workshop->latitude) && is_null($workshop->longitude) && is_null($workshop->address) && is_null($workshop->division_id)){
            notify()->warning("Please, Update Your Workshop", "Warning");
        }*/


        if($type == 'workshop'){
            return view('frontend.service.index_workshop', compact('type'));
        }

        if($type == 'fuel'){
            return view('frontend.service.index_fuel', compact('type'));
        }

        if($type == 'raker'){
            return view('frontend.service.index_raker', compact('type'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $divisions  = Division::where('status', 1)->get();
        $districts  = District::where('status', 1)->get();
        $upazilas   = Upazila::where('status', 1)->get();
        $unions     = Union::where('status', 1)->get();

        // Service Type Name Define
        if($type == 'workshop'){
            $service_type = 1;
            $service_name = 'Workshop';
        }elseif ($type == 'fuel'){
            $service_type = 2;
            $service_name = 'Fuel Station';
        }elseif ($type == 'raker'){
            $service_type = 3;
            $service_name = 'Raker';
        }

        return view('frontend.service.create', compact('type', 'service_type', 'service_name', 'divisions', 'districts', 'upazilas', 'unions'));
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
            'contact_no'        => 'required|max:15',
//            'license_number'    => 'required|max:25',
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
            $workshop->type = 2;
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

//            if ($request->has('image')) {
//                $image = uploadImage($request->image, "images/workshop/logo/");
//                $workshop->logo = $image;
//            }

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
                'success' => "Created Successfully",
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
    /*public function edit($type, $id)
    {
        return $type . '=' .$id;
    }*/

    public function edit(string $type, int $id)
    {
        $workshop   = Workshop::with(['divisions', 'districts', 'upazilas', 'unions'])->findOrFail($id);
        $divisions  = Division::where('status', 1)->get();
        $districts  = District::where('status', 1)->get();
        $upazilas   = Upazila::where('status', 1)->get();
        $unions     = Union::where('status', 1)->get();

        // Service Type Name Define
        if($type == 'workshop'){
            $service_type = 1;
            $service_name = 'Workshop';
        }elseif ($type == 'fuel'){
            $service_type = 2;
            $service_name = 'Fuel Station';
        }elseif ($type == 'raker'){
            $service_type = 3;
            $service_name = 'Raker';
        }

        return view('frontend.service.edit', compact('type', 'service_type', 'service_name', 'workshop', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $type)
    {
        $request->validate([
            'id'                => 'required|numeric',
            'name'              => 'required|max:80',
//            'division_id'       => 'required',
//            'district_id'       => 'required',
//            'upazila_id'        => 'required',
//            'union_id'          => 'required',
            'address'           => 'required|max:200',
            'contact_no'        => 'required|max:15',
//            'license_number'    => 'required|max:25',
            'latitude'          => 'required|max:200',
            'longitude'         => 'required|max:200',
            'description'       => 'max:1000',
        ]);

        $workshop = Workshop::findOrFail($request->id);
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

        /*if ($request->image) {
            $image = uploadImage($request->image, "images/workshop/logo/");
            $workshop->logo = $image;
        }*/



        /*if ($request->has('images_signature')) {
            $image = uploadImage($request->images_signature, "images/workshop/signature/");
            $workshop->signature = $image;
        }
        if ($request->has('image_cover_photo')) {
            $image = uploadImage($request->image_cover_photo, "images/workshop/cover_photo/");
            $workshop->cover_photo = $image;
        }*/
        $workshop->save();

        notify()->success(Str::ucfirst($type)." Updated", "Success");
        return redirect()->route('service.type.index', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
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

    //--Service Type [1=workshop, 2=fuel, 3=Raker]
    public function serviceType(Request $request, $type)
    {
        //--When Incomplete Workshop Profile
        /*$workshop = Workshop::where('user_id', auth()->user()->id)->first();
        if(is_null($workshop->latitude) && is_null($workshop->longitude) && is_null($workshop->address) && is_null($workshop->division_id)){
            notify()->warning("Please, Update Your Workshop", "Warning");
        }*/

        if ($request->ajax()) {
            $workshops = Workshop::with('user')->where('type', $type)->get();
            /*$workshops = Workshop::with('user');*/
            return DataTables::of($workshops)
                ->addIndexColumn()

                //--workshop logo field
                ->addColumn('define_logo', function ($row) {
                    $logo_check = $row->logo;
                    $logo       = asset('images/workshop/logo/' . $row->logo);
                    return view('frontend.workshops.field_logo', compact(['logo', 'logo_check']));
                })

                //--workshop name
                ->addColumn('define_name', function ($row) {
                    $name           = $row->name;
                    $address        = $row->address;
                    $description    = $row->description;
                    return view('frontend.workshops.field_workshop_name', compact('name', 'address', 'description'));
                })

                //--workshop owner name
                ->addColumn('define_owner_name', function ($row) {
                    $name = isset($row->user->name) ? $row->user->name : 'NA';
                    return $name;
                })

                ->addColumn('define_coordinates', function ($row) {
                    $latitude   = $row->latitude;
                    $longitude  = $row->longitude;
                    return view('frontend.workshops.field_latitude_longitude', compact('latitude', 'longitude'));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    // service type name define
                    if($row->type == 1){
                        $type = 'workshop';
                    }elseif($row->type == 2){
                        $type = 'fuel';
                    }elseif($row->type == 3){
                        $type = 'raker';
                    }

                    $id = $row->id;
                    $details = false;
                    return view('common.action_service', compact(['id', 'details', 'type']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }
    }

}
