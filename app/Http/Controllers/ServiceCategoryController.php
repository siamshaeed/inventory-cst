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

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $service_category = ServiceCategory::orderByDesc('id')->get();
            return DataTables::of($service_category)
                ->addIndexColumn()

                // service category logo column
                ->addColumn('define_logo', function ($row) {
                    $logo_check = $row->logo;
                    $logo = asset('images/service_category_logo/'.$row->logo);
                    return view('service_category.service_logo', compact(['logo', 'logo_check']));
                })

                // service category Status column
                ->addColumn('define_status', function ($row) {
                    $id = $row->id;
                    $status = $row->status;
                    $tbl_name   = 'service_categories';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'service-category';
                    $details = false;
                    return view('common.action', compact(['id', 'module', 'details']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }
        return view('service_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ServiceCategory $service_category)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3|max:100',
            'description'   => 'required',
        ]);

        if($validator->fails()){
            //--validation error
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        }else{

            //--data save
            $service_category->name             = $request->name;
            $service_category->description      = $request->description;
            $service_category->status           = ($request->status == 'on') ? 1 : 0;
            /*if ($request->has('image')){
                $image = uploadImage($request->image, "images/service_category_logo/");
                $service_category->logo = $image;
            }*/
            $service_category->save();

            return response()->json([
                'status' => 200,
                'success' => 'Category Created Successfully',
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
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service_category = ServiceCategory::findOrFail($id);
        return view('service_category.edit', compact('service_category'));
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
        $request->validate([
            'name'          => 'required|min:3|max:100',
        ]);

        $service_category = ServiceCategory::findOrFail($id);
        $service_category->name             = $request->name;
        $service_category->description      = $request->description;
        $service_category->status           = ($request->status == 'on' ? 1 : 0);
        if ($request->has('image')) {
            $image = uploadImage($request->image, "images/service_category_logo/");
            $service_category->logo = $image;
        }
        $service_category->save();

        notify()->success("Service Category Updated", "Success");
        return redirect()->route('service-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return auth()->user()->id;
        $workshop = Workshop::where('user_id', auth()->user()->id)->first();
        //return $workshop->id;

        $service_list = ServiceList::where('workshop_id', $workshop->id)->where('service_cat_id', $id)->get();
        if(count($service_list) != 0){
            notify()->warning("Service Category Already Used", "warning");
            return back();
        }

        $deleted = ServiceCategory::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }

}
