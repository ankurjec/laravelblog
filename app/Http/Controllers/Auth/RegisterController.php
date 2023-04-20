<?php

namespace App\Http\Controllers\Auth;
Illuminate\Support\Facades\Auth::class;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //        //'userid' => ['required'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

      function showRegstrationForm()
     {
        return view('auth.registration_form');

     }


    protected function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'referral_code' =>'required',
        ]);


    $exists = DB::table('users')
           ->where('referral_code', $request->referral_code)
           ->exists();

    if ($exists) {
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'referred_user_id' => $request->referral_code,

        ]);
    // Auth::login($user);
    // $this->guard()->login($user);
    // $user->save();

    return redirect('/login')->with('success', 'User Registered Sucessfully!');   ;
    


        } else {
            // User does not exist in the database
            return back()->withErrors('User not found');
        }
            
            }



// protected function create(array $data)
// {
//     $referralUserId = $data['referral_user_id'] ?? null;
//     $referralUser = null;

//     if ($referralUserId) {
//         // Retrieve the referral user from the database
//         $referralUser = User::find($referralUserId);

//         // If the referral user doesn't exist, clear the referral user ID
//         if (!$referralUser) {
//             $referralUserId = null;
//         }
//     }

//     if (!$referralUser) {
//         // Return an error response if the referral user doesn't exist
//         return redirect()->back()->withErrors(['referral_user_id' => 'Invalid referral user ID.']);
//     }

//     $user = new User([
//         'name' => $data['name'],
//         'email' => $data['email'],
//         'password' => Hash::make($data['password']),
//         'referral_user_id' => $referralUserId,
//     ]);

//     // Update the referral user's statistics or perform other actions
//     // before saving the new user
//     // ...

//     $user->save();

//     return $user;
// }


}
