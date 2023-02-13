<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = Permission::all();
        if ($request->ajax()){
            return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('updated_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $module = 'permissions';
                    $details = false;
                    return view('common.action', compact(['id', 'module', 'details']));
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('permissions.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\Models\Permission $permission)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            //--data save
            $permission->name = $request->name;
            if ($request->filled('guard_name')) {
                $permission->guard_name = $request->guard_name;
            } else {
                $permission->guard_name = 'web';
            }
            $permission->save();

            return response()->json([
                'status ' => 200,
                'success' => 'Successfully Permission Created',
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
        $permission = \App\Models\Permission::findOrFail($id);
        return view('permissions.edit',compact('permission'));
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
            'name' => 'required|unique:permissions,name,'.$id
        ]);

        $permission = \App\Models\Permission::findOrFail($id);
        $permission->name = $request->name;
        if ($request->filled('guard_name')) {
            $permission->guard_name = $request->guard_name;
        } else {
            $permission->guard_name = 'web';
        }
        $permission->save();

        notify()->success("Permission Updated", "Success");
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = \App\Models\Permission::findOrFail($id);
        if($deleted){
            $deleted->delete();
            notify()->success("Permissions Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }
}
