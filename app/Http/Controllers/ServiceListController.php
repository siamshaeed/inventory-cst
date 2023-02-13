<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\ServiceCategory;
use App\Models\ServiceList;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ServiceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //--find_workshop_id
            $user_id = auth()->user()->id;
            $workshop = Workshop::where('user_id', $user_id)->first();

            if (empty($workshop)) {
                notify()->warning("Verify your Account and Create Workshop", "warning");
                return redirect()->route('workshops.index');
            }

            $service_lists = ServiceList::with('category')->where('workshop_id', $workshop->id)->orderByDesc('id')->get();
            return DataTables::of($service_lists)

                ->addIndexColumn()

                // service category logo column
                ->addColumn('define_logo', function ($row) {
                    $logo_check = $row->logo;
                    $logo = asset('images/service_list_logo/' . $row->logo);
                    return view('service_list.service_logo', compact(['logo', 'logo_check']));
                })

                // service category Status column
                ->addColumn('define_status', function ($row) {
                    $id = $row->id;
                    $status = $row->status;
                    $tbl_name   = 'service_lists';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'service-list';
                    $details = false;
                    return view('common.action', compact(['id', 'module', 'details']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }
        return view('service_list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_category = ServiceCategory::where('status', 1)->get();
        return view('service_list.create', compact('service_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ServiceList $service_list)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'service_cat_id'    => 'required',
            'name'              => 'required|min:3|max:100',
            'repair_time'       => 'required',
            'discount'          => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        }else{

            //----workshop_id
            $user_id = auth()->user()->id;
            $workshop = Workshop::where('user_id', $user_id)->first();

            $service_list->service_cat_id   = $request->service_cat_id;
            $service_list->workshop_id      = $workshop->id;
            $service_list->name             = $request->name;
            $service_list->description      = $request->description;
            $service_list->repair_time      = $request->repair_time;
            $service_list->discount         = $request->discount;
            $service_list->status           = ($request->status == 'on') ? 1 : 0;
            /*if ($request->has('image')){
                $image = uploadImage($request->image, "images/service_list_logo/");
                $service_list->logo = $image;
            }*/
            $service_list->save();

            return response()->json([
                'status' => 200,
                'success' => "Service List Created",
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
        $service_list = ServiceList::findOrFail($id);
        $service_category = ServiceCategory::where('status', 1)->get();

        return view('service_list.edit', compact('service_list', 'service_category'));
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
            'service_cat_id'    => 'required',
            'name'              => 'required|min:3|max:100',
            'repair_time'       => 'required',
            'discount'          => 'required',
        ]);

        $service_list = ServiceList::findOrFail($id);
        $service_list->service_cat_id   = $request->service_cat_id;
        $service_list->name             = $request->name;
        $service_list->description      = $request->description;
        $service_list->repair_time      = $request->repair_time;
        $service_list->discount         = $request->discount;
        $service_list->status           = ($request->status == 'on') ? 1 : 0;
        if ($request->has('image')){
            $image = uploadImage($request->image, "images/service_list_logo/");
            $service_list->logo = $image;
        }
        $service_list->save();

        notify()->success("Service List Updated", "Success");
        return redirect()->route('service-list.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = ServiceList::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }
}
