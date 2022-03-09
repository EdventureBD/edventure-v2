<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.register');
        return view('auth.new.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    //******************** OTP code starts here ***********************//

//        if (empty(request()->otp)) {
//            $request->validate(
//                [
//                    'name' => 'required|string|max:255',
//                    'email' => 'required|string|email|max:255|unique:users',
//                    'phone' => 'required|numeric|digits:11|unique:users',
//                    // 'verificationId' => 'required|min:200',
//                    'password' => 'required|string|confirmed|min:8',
//                ]
//            );
//            $input = $request->all();
//            return $this->sendOtp($input);
//        } else if (!empty(request()->otp)) {
//            if (Cache::get(request()->ip . '_otp') == request()->otp) {
//                $input = Cache::get(request()->ip . '_input');
//                Auth::login($user = User::create([
//                    'name' => $input['name'],
//                    'email' => $input['email'],
//                    'phone' => $input['phone'],
//                    'password' => Hash::make($input['password']),
//                    'is_admin' => 0,
//                    'user_type' => 3,
//                    'image' => null,
//                ]));
//                Cache::forget(request()->ip . '_otp');
//                Cache::forget(request()->ip . '_input');
//                return redirect()->route('home');
//            }
//        }
    //********************** OTP code ends here ******************************************//


        $input = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|numeric|digits:11|unique:users',
                // 'verificationId' => 'required|min:200',
                'password' => 'required|string|confirmed|min:8',
            ]
        );
         Auth::login($user = User::create([
             'name' => $input['name'],
             'email' => $input['email'],
             'phone' => $input['phone'],
             'password' => Hash::make($input['password']),
             'is_admin' => 0,
             'user_type' => 3,
             'image' => null,
         ]));

        return redirect()->route('home');
    }

    public function sendOtp($input)
    {
        $otp = mt_rand(100000, 999999);
        Cache::put(request()->ip . '_otp', $otp, 120);
        Cache::put(request()->ip . '_input', $input, 120);
        $message = "Your Edventure register otp is " . $otp;
        $client = new Client();
        $api_key = config("edv.reve_api_key");
        $api_secret = config("edv.reve_secret_key");
        $caller_id = config("edv.reve_caller_id");

        $url = "https://smpp.ajuratech.com:7790/sendtext?apikey=" . $api_key . "&secretkey=" . $api_secret . "&callerID=" . $caller_id . "&toUser=" . $input['phone'] . "&messageContent=" . $message;

        try {
            $result = $client->request('GET', $url);
            $result = $result->getBody()->getContents();
            $result = json_decode($result, true);
//             dd($result);
            if ($result['Status'] == "0") {
                return view("auth.otp");
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // catches all ClientExceptions
//            dd($e);
            return view('auth.register');

        } catch (\GuzzleHttp\Exception\ConnectException $e) {
//             dd($e);
            return view('auth.register');
        }
        return redirect()->back()->withErrors(['Failed to register! Please try again.']);
    }
}
