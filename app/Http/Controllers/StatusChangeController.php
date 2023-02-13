<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\ServiceRequest;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatusChangeController extends Controller
{
    //--StatusChange
    public function status(Request $request) {

        //dd($request->all());
        $id             = $request->data_id;
        $check_value    = $request->check_value;
        $tbl_name       = $request->tbl_name;

        $plan = DB::table($tbl_name)
            ->where('id', $id)
            ->update(['status' => $check_value]);

        if($plan){
            if($check_value == 1){
                //--Status Active
                return response()->json([
                    'status' => 200,
                    'success' => 'Status Active Successfully',
                ]);
            }else{
                //--Status DeActivated
                return response()->json([
                    'status' => 200,
                    'success' => 'Status DeActivated Successfully',
                ]);
            }

        }else{
            return response()->json([
                'status' => 400,
                'error' => 'Something Went Wrong ?'
            ]);
        }

    }
}
