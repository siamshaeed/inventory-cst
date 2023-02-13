<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\WorkshopRequest;
use App\Models\User;
use App\Models\Workshop;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showProfile()
    {
        $user = User::find(auth()->id());

        return view('frontend.profile.profile_info', compact('user'));
    }


    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $user = User::find(auth()->id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->photo = $request->photo ? $request->photo->store('users') : $user->photo;
        $user->save();

        return response()->json(
            [
                'message' => 'Profile updated successfully'
            ]
        );
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showWorkshop()
    {
        $workshop = Workshop::firstWhere(
            [
                'user_id' => auth()->id()
            ]
        );

        return view('frontend.profile.workshop-info', compact('workshop'));
    }


    /**
     * @param WorkshopRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateWorkshop(WorkshopRequest $request)
    {
        $workshop = Workshop::firstWhere(
            [
                'user_id' => auth()->id()
            ]
        );

        $workshop->name = $request->name;
        $workshop->description = $request->description;
        $workshop->logo = $request->logo ? $request->logo->store('workshops') : $workshop->logo;
        $workshop->signature = $request->signature ? $request->signature->store('workshops') : $workshop->signature;
        $workshop->latitude = $request->latitude;
        $workshop->longitude = $request->longitude;
        $workshop->license_number = $request->license_number;
        $workshop->address = $request->address;
        $workshop->contact_no = $request->contact_no;
        $workshop->opening_time = $request->opening_time;
        $workshop->closing_time = $request->closing_time;

        $workshop->save();

        return response()->json(
            [
                'message' => 'Workshop updated successfully'
            ]
        );
    }







    //
    public function profilePassword(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'current_password'      => ['required', new MatchOldPassword],
                'new_password'          => ['required'],
                'new_confirm_password'  => ['same:new_password'],
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }else{

                User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                return response()->json([
                    'status ' => 200,
                    'success' => 'Successfully Password Updated',
                ]);
            }

        }

        return view('frontend.profile.profile_password');
    }

}
