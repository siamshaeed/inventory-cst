<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkshopResource;
use App\Jobs\ServiceRequestJob;
use App\Jobs\ServiceResponseJob;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\Workshop;
use Faker\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class FindWorkshopController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendRequest(Request $request)
    {
        if (auth()->user()->pendingRequests()->exists()) {
            return response()->json([
                'message' => 'Please cancel all your pending requests'
            ], 422);
        }

        $serviceRequest = new ServiceRequest();
        $serviceRequest->customer_id = auth()->id();
        $serviceRequest->workshop_id  = $request->workshop_id;
        $serviceRequest->customer_request_time = now();
        $serviceRequest->workshop_distance = $request->distance;
        $serviceRequest->workshop_position = $request->workshop_position;
        $serviceRequest->user_position = $request->user_position;
        $serviceRequest->save();

        ServiceRequestJob::dispatch($serviceRequest, auth()->user());

        return response()->json(
            [
                'message' => 'Request sent successfully',
                'serviceRequest' => $serviceRequest
            ]
        );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function nearestWorkshop(Request $request)
    {

        //Session::put('register_previous_url', 'sdfsdfsdfsd');
        /*if(session()->has('register_previous_url')){
            return redirect(Session::get('register_previous_url'));
            //return 'okey nearest-workshop redirect';
        }*/

        /*return route('nearest.workshop');

        return Session::get('register_previous_url');*/


        //dd($request->all());
        //return Workshop::with('serviceFeedback:id,workshop_id,rating')->where('type', 3)->get();

        Session::put('previous_url', URL::current());

        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(), [
                'pac_input' => 'required',
                'shop_type' => 'required',
                'latitude'  => 'required',
                'longitude' => 'required',
                'range_type'    => 'required',
            ]);
            if($validator->fails()){
                notify("Enter Your Location", "Warning");
                return redirect()->back();
            }

            // Shop_type define
            if($request->shop_type == 1){
                $shop_type = 1;
            }elseif ($request->shop_type == 2){
                $shop_type = 2;
            }elseif ($request->shop_type == 3){
                $shop_type = 3;
            }

            // put LatLng into session
            Session::put('shop_type',   $shop_type);
            Session::put('lat',         $request->latitude);
            Session::put('lng',         $request->longitude);

            Session::put('user_location',   $request->pac_input);
            Session::put('range',           $request->range);
            Session::put('range_type',      $request->range_type);
            Session::put('status',      1);
        }


        //return Session::get('lat');


        //dd($request->all());

        // without latitude and longitude return redirect home page
        /*if((!$request->has('latitude')) && (!$request->has('longitude'))){
            notify("Please, Enter Your Location !", "Warning");
            return redirect()->route('home');
        }*/

        /*if($request->isMethod('POST')){
            notify("Enter Your Location !", "Warning");
            return redirect()->back();
        }*/




        /*if(($request->isMethod('GET')) && (!is_null(Session::get('lat')))){
            return view('frontend.workshops.list-workshop');
        }*/

        if(!Session::get('status')){
            notify("Please, Enter A Location", "Warning");
        }
        return view('frontend.workshops.list-workshop');
    }


    public function insertData()
    {
        $data = [];

        $faker = Factory::create();

        DB::beginTransaction();
        try {
            for ($i = 0; $i < 25; $i++) {
                $user = new User();
                $user->name = $faker->name;
                $user->email = $faker->email;
                $user->phone_number = $faker->phoneNumber;
                $user->password = bcrypt('password');
                $user->user_type = 2;
                $user->status = 1;
                $user->save();

                $workshop = new Workshop();
                $workshop->name = $faker->name;
                $workshop->description = $faker->text;
                $workshop->latitude = $faker->latitude;
                $workshop->longitude = $faker->longitude;
                $workshop->user_id = $user->id;
                $workshop->save();
            }
            DB::commit();
            notify()->success('Operation Successful', 'Success');
        } catch(QueryException $exception){
            DB::rollBack();
            return $exception->getMessage();
        }



    }


    public function getWorkshopList(Request $request)
    {
        $lat = $request->position['lat'];
        $lng = $request->position['lng'];

        $haversine = "CEIL((6371e3 * acos(
         cos( radians($lat) ) * cos( radians( latitude ) )
            * cos( radians( longitude ) - radians($lng) )
            + sin( radians($lat) )". "* sin( radians( latitude ) )
             ) ))"
        ;


        // put LatLng into session
        Session::put('shop_type',       $request->serviceType);
        Session::put('lat',             $lat);
        Session::put('lng',             $lng);

        Session::put('user_location',   $request->pac_input);
        Session::put('range',           $request->range_define);
        Session::put('range_type',      $request->range_type);
        Session::put('status',      1);


        $workshops = Workshop::with('serviceFeedback:id,workshop_id,rating')->where('type', $request->serviceType)
            ->withCount('serviceFeedback')
            ->select('id', 'user_id', 'name', 'description', 'latitude', 'longitude', 'logo', 'address')
            ->selectRaw("{$haversine} as distance")
            ->when($request->range, function ($query, $range) {
                $query->having('distance', '<=', $range);
            })
            ->orderBy('distance')
            ->paginate($request->total);

        return WorkshopResource::collection($workshops);
    }




    public function getDistance($from, $to) {
//        $R = 6371e3; // metres
//        $φ1 = from.lat * Math.PI / 180; // φ, λ in radians
//        $φ2 = to.lat * Math.PI / 180;
//        $Δφ = (to.lat - from.lat) * Math.PI / 180;
//        $Δλ = (to.lng - from.lng) * Math.PI / 180;
//
//        $a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(
//                Δλ / 2);
//        $c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
//
//        return R * c;


    }



    /**
     * @param Request $request
     * @param ServiceRequest $serviceRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptRequest(Request $request, ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('workshop');
        $serviceRequest->status = $request->status ? 1 : 2;
        $serviceRequest->save();

        ServiceResponseJob::dispatch($serviceRequest);

        return response()->json(
            [
                'message' => $serviceRequest->status == 1 ? 'Request has been accepted' : 'Request has been rejected',
                'color' => $serviceRequest->status == 1 ? 'green' : 'red'
            ]
        );
    }


}
