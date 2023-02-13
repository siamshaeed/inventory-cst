<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Rules\FullNameRule;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{


    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function loginView()
    {

    }


    public function loginNew()
    {

        return view('auth.login-page');

    }

    public function otp(Request $request)
    {
        if($request->isMethod('POST')){

            //dd($request->all());
            $endTime = Carbon::now();
            if(Session::get('startTime')->lte($endTime)){
                //notify()->warning("OTP Time Expired", "Warning");
                Session::flash('msg_error', 'OTP Time Expired');
                return redirect()->route('otp');
            }

            $user = User::where('phone_number', Session::get('phone_number'))->first();

            /* OPT Match Check */
            $code = $request->code_1.$request->code_2.$request->code_3.$request->code_4;
            if($code != $user->otp){
                Session::flash('msg_error', "OTP Can't Matched");
                return redirect()->route('otp');
            }

            User::find($user->id)->update(['is_verified' => 1]);

            //--Define Session Null Value
            Session::put('user_id', null);
            Session::put('phone_number', null);
            Session::put('otp', null);
            Session::put('password', null);
            Session::put('startTime', null);
            $register_previous_url = Session::get('register_previous_url');

            Auth::login($user);

            // Redirect to /nearest-workshop
            if($register_previous_url == route('nearest.workshop')){
                notify()->success("Welcome To Driver Khuji", "Success");
                return redirect()->route('nearest.workshop');
            }

            /*// check user location found or not
            if(isset($lng) && isset($lng)){
                return redirect()->intended('nearest-workshop');
            }*/

            notify()->success("Welcome To Driver Khuji", "Success");
            return redirect()->intended('home');
        }

        if(Session::get('otp')){
            return view('auth.otp');
        }else{
            return redirect()->route('register');
        }

    }

    public function otpResend()
    {
        if(is_null(Session::get('user_id')) && is_null(Session::get('otp'))){
            notify()->warning("Whoops! Something Went Wrong");
            return redirect()->route('login');
        }

        $otp = random_int(1000, 9999);
        User::find(Session::get('user_id'))->update(['otp' => $otp]);
        Session::put('otp', $otp);
        Session::put('startTime', Carbon::now()->addSeconds(60));

        return view('auth.otp');
    }

    public function otpAgain(Request $request)
    {
        if ($request->isMethod('POST')) {

            $request->validate(
                [
                    'phone_number'  => ['required', 'regex:/^((013)|(014)|(015)|(016)|(017)|(018)|(019))[0-9]{8}/', 'digits:11'],
                ]
            );

            $user_check = User::where('phone_number', $request->phone_number)->first();
            if(is_null($user_check)){

                //notify()->warning("Phone Number Does Not Match on This Record", "Warning");
                Session::flash('msg_error', 'Phone Number Does Not Match on This Record');
                return redirect()->route('otp.again');

            }

            $otp = random_int(1000, 9999);
            User::where('id', $user_check->id)->update(['otp' => $otp]);
            $user = User::where('id', $user_check->id)->first();

            //--Data Store into Session
            Session::put('user_id', $user->id);
            Session::put('phone_number', $user->phone_number);
            Session::put('otp', $otp);
            Session::put('startTime', Carbon::now()->addSeconds(60));

            return view('auth.otp');
        }

        return view('auth.otp_again');
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        // define previous url(come form /nearest-workshop this url)
        //$define_previous_url = $request->define_previous_url;

        // check user location found or not
        //$lat = Session::get('lat');
        //$lng = Session::get('lng');



        if ($request->isMethod('POST')) {
            $request->validate([
                'phone_number' => ['required'],
                'password' => ['required'],
            ]);

            $withEmail = ['email' => $request->phone_number, 'password' => $request->password];
            $withPhoneNumber = ['phone_number' => $request->phone_number, 'password' => $request->password];


            if (Auth::attempt($withPhoneNumber) || Auth::attempt($withEmail)) {
                $request->session()->regenerate();

                // Redirect to /nearest-workshop
                /*if ($define_previous_url == route('nearest.workshop')) {
                    notify()->success("Welcome to our Service", "Success");
                    return redirect()->intended('nearest-workshop');
                }*/


                notify()->success("Welcome To Driver Khuji", "Success");
                return redirect()->intended('home');

                /*// check user location found or not
                if(isset($lng) && isset($lng)){
                    return redirect()->intended('nearest-workshop');
                }
                return redirect()->intended('home');*/
            }

            return back()->withErrors([
                'phone_number' => 'The provided credentials do not match our records.',
            ]);
        }


        return view('auth.login');

    }



    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request, $previous_url = null)
    {
        // Trace previous url define
        Session::put('register_previous_url', url('/').'/'.$previous_url);


        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'name' => ['required', 'min:3', 'max:100'],
                    //'name' => ['required', 'min:3', 'max:100', new FullNameRule()],
                    //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone_number'  => ['required', 'regex:/^((013)|(014)|(015)|(016)|(017)|(018)|(019))[0-9]{8}/', 'digits:11', 'unique:users'],
                    'password' => ['required', 'confirmed', 'min:4'],
                ]
            );

            DB::beginTransaction();
            try {
                $otp = random_int(1000, 9999);
                $user = new User();
                $user->name = $request->name;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt($request->password);
                $user->user_type = $request->hasWorkshop ? 2 : 3;
                $user->otp = $otp;
                $user->status = 0;
                $user->save();

                $user->syncRoles(config('default.roles.customer'));

                if ($request->hasWorkshop) {
                    $request->validate(
                        [
                            'workshop_name' => 'required|string|max:255',
                            'license_number' => 'required|string|unique:workshops|max:255',
                        ]
                    );

                    $workshop = new Workshop();
                    $workshop->user_id = $user->id;
                    $workshop->name = $request->workshop_name;
                    $workshop->license_number = $request->license_number;
                    $workshop->save();

                    $user->syncRoles(config('default.roles.workshop'));
                }
                //Auth::login($user);
                DB::commit();

                //--Data Store into Session
                Session::put('user_id', $user->id);
                Session::put('phone_number', $user->phone_number);
                Session::put('otp', $otp);
                Session::put('password', $request->password);
                Session::put('startTime', Carbon::now()->addSeconds(60));
                Session::put('register_previous_url', $request->register_previous_url);

                return redirect()->route('otp');
                //return redirect()->intended('home');

            } catch (QueryException $exception) {
                Log::error('registration-error', [$exception->getMessage()]);
                return redirect()->back();
            }

        }


        return view('auth.register');
    }



    public function registerWorkshop(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'confirmed', Password::defaults()],

            'workshop_name'     => ['required', 'string', 'max:255'],
            'license_number'    => ['required', 'string', 'max:20'],
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = 2; // 3 means workshop
        $user->is_verified = 1;
        $user->status = 1;
        $user->save();

        $workshop = new Workshop();
        $workshop->user_id          = $user->id;
        $workshop->name             = $request->workshop_name;
        $workshop->license_number   = $request->license_number;
        $workshop->save();

        Auth::login($user);

        return redirect()->intended('home');

    }



    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function registerView()
    {
        return view('auth.register');
    }



}
